<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('published', true))
            ->findOrFail($data['product_id']);

        $item = Cart::firstOrNew([
            'user_id' => $request->user()->id,
            'product_id' => $data['product_id'],
        ]);
        $newQuantity = $item->quantity + $data['quantity'];
        if ($newQuantity > 99 || $newQuantity > $product->stock) {
            throw ValidationException::withMessages(['quantity' => 'The requested quantity is not available.']);
        }
        $item->quantity = $newQuantity;
        $item->save();

        return redirect()->route('cart.index')->with('status', 'Product added to cart.');
    }

    public function index(Request $request): View
    {
        $cartItems = Cart::where('user_id', $request->user()->id)
            ->with('product.category')
            ->get();
        $total = $cartItems->sum(fn (Cart $item) => ($item->product?->price ?? 0) * $item->quantity);
        $currency = StoreSetting::current()->currency;

        return view('public.cart', compact('cartItems', 'total', 'currency'));
    }

    public function remove(Request $request, Cart $cart): RedirectResponse
    {
        abort_unless($cart->user_id === $request->user()->id, 404);
        $cart->delete();

        return redirect()->route('cart.index');
    }

    public function update(Request $request, Cart $cart): RedirectResponse
    {
        abort_unless($cart->user_id === $request->user()->id, 404);
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        $product = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('published', true))
            ->find($cart->product_id);
        if (!$product || $data['quantity'] > $product->stock) {
            throw ValidationException::withMessages(['quantity' => 'The requested quantity is not available.']);
        }
        $cart->update(['quantity' => $data['quantity']]);

        return redirect()->route('cart.index')->with('status', 'Cart updated.');
    }
}
