<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\StoreSetting;
use App\Mail\OrderPlaced;
use App\Mail\OrderUpdated;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();
});

it('creates an unpaid order from a published cart', function () {
    $customer = cartUser();
    $product = cartProduct();
    Cart::create(['user_id' => $customer->id, 'product_id' => $product->id, 'quantity' => 2]);

    $this->actingAs($customer)->post(route('checkout.store'), [
        'customer_name' => 'Test Customer',
        'phone' => '01012345678',
        'delivery_method' => 'shipping',
        'address' => '123 Test Street',
        'payment_method' => 'cash_on_delivery',
    ])->assertRedirect(route('orders.show', 1));

    $order = Order::firstOrFail();
    expect($order->payment_status)->toBe('unpaid')
        ->and((float) $order->subtotal)->toBe(100.0)
        ->and($order->items()->count())->toBe(1)
        ->and($order->events()->count())->toBe(1)
        ->and($product->refresh()->stock)->toBe(8)
        ->and(Cart::count())->toBe(0);
    $this->actingAs($customer)->get(route('orders.show', $order))->assertOk()->assertSee('unpaid');
    Mail::assertQueued(OrderPlaced::class, 1);
});

it('rejects unavailable payment methods and private order access', function () {
    $customer = cartUser();
    $other = cartUser();
    $product = cartProduct();
    Cart::create(['user_id' => $customer->id, 'product_id' => $product->id, 'quantity' => 1]);

    $this->actingAs($customer)->post(route('checkout.store'), [
        'customer_name' => 'Test Customer',
        'phone' => '01012345678',
        'delivery_method' => 'pickup',
        'payment_method' => 'card',
    ])->assertSessionHasErrors('payment_method');
    expect(Order::count())->toBe(0);

    StoreSetting::current()->update([
        'bank_transfer_enabled' => true,
        'bank_transfer_instructions' => 'Request transfer details from the seller.',
    ]);
    $this->actingAs($customer)->post(route('checkout.store'), [
        'customer_name' => 'Test Customer',
        'phone' => '01012345678',
        'delivery_method' => 'pickup',
        'payment_method' => 'bank_transfer',
    ])->assertRedirect(route('orders.show', 1));

    $this->actingAs($other)->get(route('orders.show', 1))->assertNotFound();
});

it('allows only admins to configure payment and delivery options', function () {
    $customer = cartUser();
    $admin = cartUser();
    $customer->forceFill(['email_verified_at' => now()])->save();
    $admin->forceFill(['is_admin' => true, 'email_verified_at' => now()])->save();

    $this->actingAs($customer)->put(route('admin.store-settings.update'), [
        'store_name' => 'Test Store', 'currency' => 'EUR', 'pickup_enabled' => 1, 'bank_transfer_enabled' => 1,
        'bank_transfer_instructions' => 'Transfer details',
    ])->assertForbidden();

    $this->actingAs($admin)->put(route('admin.store-settings.update'), [
        'store_name' => 'Test Store', 'currency' => 'EUR', 'pickup_enabled' => 1, 'bank_transfer_enabled' => 1,
        'bank_transfer_instructions' => 'Transfer details',
    ])->assertRedirect();

    $settings = StoreSetting::current()->refresh();
    $this->actingAs($admin)->get(route('admin.store-settings.edit'))->assertOk()->assertSee('Store settings');
    expect($settings->currency)->toBe('EUR')
        ->and($settings->shipping_enabled)->toBeFalse()
        ->and(array_keys($settings->paymentMethods()))->toBe(['bank_transfer']);
});

it('rejects disabled methods during checkout', function () {
    $customer = cartUser();
    $product = cartProduct();
    Cart::create(['user_id' => $customer->id, 'product_id' => $product->id, 'quantity' => 1]);
    StoreSetting::current()->update(['shipping_enabled' => false]);

    $this->actingAs($customer)->post(route('checkout.store'), [
        'customer_name' => 'Test Customer',
        'phone' => '01012345678',
        'delivery_method' => 'shipping',
        'address' => '123 Test Street',
        'payment_method' => 'cash_on_delivery',
    ])->assertSessionHasErrors('delivery_method');
    expect(Order::count())->toBe(0);
});

it('lets only admins review and manually update orders', function () {
    $customer = cartUser();
    $admin = cartUser();
    $customer->forceFill(['email_verified_at' => now()])->save();
    $admin->forceFill(['is_admin' => true, 'email_verified_at' => now()])->save();
    $order = Order::create([
        'user_id' => $customer->id,
        'customer_name' => 'Test Customer',
        'phone' => '01012345678',
        'delivery_method' => 'pickup',
        'payment_method' => 'cash_on_delivery',
        'status' => 'pending',
        'payment_status' => 'unpaid',
        'subtotal' => 100,
        'currency' => 'USD',
    ]);

    $this->actingAs($customer)->get(route('admin.orders.show', $order))->assertForbidden();
    $this->actingAs($customer)->put(route('admin.orders.update', $order), [
        'status' => 'fulfilled', 'payment_status' => 'paid',
    ])->assertForbidden();

    $this->actingAs($admin)->get(route('admin.orders.index'))->assertOk()->assertSee('Test Customer');
    $this->actingAs($admin)->get(route('admin.orders.show', $order))->assertOk()->assertSee('Test Customer');
    $this->actingAs($admin)->put(route('admin.orders.update', $order), [
        'status' => 'fulfilled', 'payment_status' => 'paid',
    ])->assertRedirect();
    expect($order->refresh()->payment_status)->toBe('paid');
    Mail::assertQueued(OrderUpdated::class, 1);
});

it('rejects insufficient stock at cart and checkout and restores it once on cancellation', function () {
    $customer = cartUser();
    $admin = cartUser();
    $admin->forceFill(['is_admin' => true])->save();
    $product = cartProduct();
    $product->update(['stock' => 1]);

    $this->actingAs($customer)->post(route('cart.add'), [
        'product_id' => $product->id, 'quantity' => 2,
    ])->assertSessionHasErrors('quantity');

    Cart::create(['user_id' => $customer->id, 'product_id' => $product->id, 'quantity' => 2]);
    $this->actingAs($customer)->post(route('checkout.store'), [
        'customer_name' => 'Test', 'phone' => '01012345678',
        'delivery_method' => 'pickup', 'payment_method' => 'cash_on_delivery',
    ])->assertSessionHasErrors('cart');
    expect(Order::count())->toBe(0);

    Cart::where('user_id', $customer->id)->update(['quantity' => 1]);
    $this->actingAs($customer)->post(route('checkout.store'), [
        'customer_name' => 'Test', 'phone' => '01012345678',
        'delivery_method' => 'pickup', 'payment_method' => 'cash_on_delivery',
    ])->assertRedirect(route('orders.show', 1));
    expect($product->refresh()->stock)->toBe(0);

    $order = Order::firstOrFail();
    $this->actingAs($admin)->put(route('admin.orders.update', $order), [
        'status' => 'cancelled', 'payment_status' => 'unpaid',
    ])->assertRedirect();
    expect($product->refresh()->stock)->toBe(1)
        ->and($order->events()->count())->toBe(2);
    $this->actingAs($admin)->put(route('admin.orders.update', $order), [
        'status' => 'cancelled', 'payment_status' => 'unpaid',
    ])->assertRedirect();
    expect($product->refresh()->stock)->toBe(1);
});
