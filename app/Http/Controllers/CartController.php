<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = Cart::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ],
        ['quantity' => DB::raw('quantity + ' . $request->quantity)]
    );

    return response()->json(['success' => true, 'cart' => $cartItem]);
}

public function index()
{
    $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
    // $total = $cartItems->sum(function($item) {
    //     return $item->product->price * $item->quantity;
    // });
    return view('public.single-product', compact('cartItems'));
}


public function total()
{
    return Cart::join('products','products.id','=','carts.product_id')
    ->selectRaw("sum(products.price * carts.quantity as total )")
    ->value('total');
   
}


}
