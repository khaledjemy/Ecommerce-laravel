<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderNotifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders', ['orders' => Order::latest()->paginate(20)]);
    }

    public function show(Order $order)
    {
        return view('admin.order', ['order' => $order->load('items', 'events.actor')]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'fulfilled', 'cancelled'])],
            'payment_status' => ['required', Rule::in(['unpaid', 'paid'])],
        ]);

        if ($data['status'] === 'cancelled' && $data['payment_status'] === 'paid') {
            return back()->withErrors(['status' => 'Resolve a paid order before cancelling it.']);
        }

        $changed = DB::transaction(function () use ($request, $order, $data) {
            $order = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
            if ($order->status === 'cancelled' && $data['status'] !== 'cancelled') {
                throw \Illuminate\Validation\ValidationException::withMessages(['status' => 'Cancelled orders cannot be reopened.']);
            }
            if ($data['status'] === 'cancelled' && $order->payment_status === 'paid') {
                throw \Illuminate\Validation\ValidationException::withMessages(['status' => 'Resolve the payment before cancelling this order.']);
            }
            if ($order->status === $data['status'] && $order->payment_status === $data['payment_status']) {
                return false;
            }

            if ($data['status'] === 'cancelled' && $order->status !== 'cancelled') {
                foreach ($order->items()->orderBy('product_id')->get() as $item) {
                    if ($item->product_id) {
                        Product::whereKey($item->product_id)->increment('stock', $item->quantity);
                    }
                }
            }

            $order->events()->create([
                'actor_id' => $request->user()->id,
                'from_status' => $order->status,
                'to_status' => $data['status'],
                'from_payment_status' => $order->payment_status,
                'to_payment_status' => $data['payment_status'],
            ]);
            $order->update($data);
            return true;
        });

        if ($changed) {
            app(OrderNotifier::class)->updated($order->refresh());
        }

        return back()->with('status', 'Order updated.');
    }
}
