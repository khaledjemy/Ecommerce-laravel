<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

function cartUser(): User
{
    $user = User::create([
        'firstname' => 'Cart',
        'lastname' => 'Customer',
        'username' => 'cart-'.uniqid(),
        'email' => uniqid().'@example.test',
        'password' => 'password123',
    ]);
    $user->forceFill(['active' => '1', 'email_verified_at' => now()])->save();

    return $user;
}

function cartProduct(bool $published = true): Product
{
    $category = Category::create([
        'category_name' => 'men',
        'description' => 'Test category',
        'image' => 'category.jpg',
        'published' => true,
    ]);

    return Product::create([
        'name' => 'Demo jacket',
        'price' => 50,
        'rate' => 5,
        'image' => 'jacket.jpg',
        'published' => $published,
        'stock' => 10,
        'category_id' => $category->id,
    ]);
}

it('requires a customer to sign in before adding to cart', function () {
    $this->post('/cart/add', ['product_id' => 1, 'quantity' => 1])
        ->assertRedirect('/login');
});

it('adds published products and keeps each cart private', function () {
    $product = cartProduct();
    $customer = cartUser();
    $other = cartUser();

    $this->actingAs($customer)->post('/cart/add', [
        'product_id' => $product->id,
        'quantity' => 2,
    ])->assertRedirect(route('cart.index'));

    $this->actingAs($customer)->post('/cart/add', [
        'product_id' => $product->id,
        'quantity' => 3,
    ])->assertRedirect(route('cart.index'));

    $item = Cart::firstOrFail();
    expect($item->quantity)->toBe(5);
    $this->actingAs($customer)->get('/cart')->assertOk()->assertSee('250.00');
    $this->actingAs($customer)->patch(route('cart.update', $item), ['quantity' => 4])
        ->assertRedirect(route('cart.index'));
    expect($item->refresh()->quantity)->toBe(4);
    $this->actingAs($other)->patch(route('cart.update', $item), ['quantity' => 1])->assertNotFound();
    $this->actingAs($other)->get('/cart')->assertOk()->assertDontSee('Demo jacket');
    $this->actingAs($other)->delete('/cart/'.$item->id)->assertNotFound();
    $this->actingAs($customer)->delete('/cart/'.$item->id)->assertRedirect(route('cart.index'));
    expect(Cart::count())->toBe(0);
});

it('rejects unpublished products from the cart', function () {
    $product = cartProduct(false);

    $this->actingAs(cartUser())->post('/cart/add', [
        'product_id' => $product->id,
        'quantity' => 1,
    ])->assertNotFound();
});
