<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\StoreSetting;
use App\Models\Product;
use App\Services\OrderNotifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function create(Request $request)
    {
        $items = Cart::where('user_id', $request->user()->id)->with('product.category')->get();
        abort_if($items->isEmpty(), 404);

        $settings = StoreSetting::current();
        return view('public.checkout', compact('items', 'settings'));
    }

    public function store(Request $request)
    {
        $settings = StoreSetting::current();
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'delivery_method' => ['required', Rule::in(array_keys($settings->deliveryMethods()))],
            'address' => ['required_if:delivery_method,shipping', 'nullable', 'string', 'max:255'],
            'payment_method' => ['required', Rule::in(array_keys($settings->paymentMethods()))],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = DB::transaction(function () use ($request, $data, $settings) {
            $settings->refresh();
            if (!array_key_exists($data['delivery_method'], $settings->deliveryMethods())
                || !array_key_exists($data['payment_method'], $settings->paymentMethods())) {
                throw \Illuminate\Validation\ValidationException::withMessages(['checkout' => 'A selected option is no longer available.']);
            }
            $items = Cart::where('user_id', $request->user()->id)
                ->with('product.category')->lockForUpdate()->get();
            if ($items->isEmpty()) {
                throw \Illuminate\Validation\ValidationException::withMessages(['cart' => 'Your cart is empty.']);
            }
            foreach ($items as $item) {
                if (!$item->product || !$item->product->published || !$item->product->category?->published) {
                    throw \Illuminate\Validation\ValidationException::withMessages(['cart' => 'A product in your cart is no longer available.']);
                }
            }

            $products = Product::whereIn('id', $items->pluck('product_id')->sort()->values())
                ->orderBy('id')->lockForUpdate()->get()->keyBy('id');
            foreach ($items as $item) {
                if ($products[$item->product_id]->stock < $item->quantity) {
                    throw \Illuminate\Validation\ValidationException::withMessages(['cart' => 'A product in your cart does not have enough stock.']);
                }
            }

            $subtotal = $items->sum(fn ($item) => round($item->product->price * $item->quantity, 2));
            $order = Order::create(array_merge($data, [
                'user_id' => $request->user()->id,
                'subtotal' => $subtotal,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'currency' => $settings->currency,
            ]));
            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'line_total' => round($item->product->price * $item->quantity, 2),
                ]);
                $products[$item->product_id]->decrement('stock', $item->quantity);
            }
            Cart::where('user_id', $request->user()->id)->delete();

            $order->events()->create([
                'actor_id' => $request->user()->id,
                'to_status' => 'pending',
                'to_payment_status' => 'unpaid',
            ]);

            return $order;
        });

        app(OrderNotifier::class)->placed($order);

        return redirect()->route('orders.show', $order);
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 404);

        return view('public.order', ['order' => $order->load('items')]);
    }
}
