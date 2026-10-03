@extends('admin.layouts.main')

@section('content')
<div class="right_col" role="main">
    <h1>Orders</h1>
    <div class="table-responsive"><table class="table table-striped">
        <thead><tr><th>ID</th><th>Customer</th><th>Date</th><th>Subtotal</th><th>Status</th><th>Payment</th><th></th></tr></thead>
        <tbody>@forelse ($orders as $order)
            <tr><td>#{{ $order->id }}</td><td>{{ $order->customer_name }}</td><td>{{ $order->created_at }}</td><td>{{ $order->currency }} {{ number_format($order->subtotal, 2) }}</td><td>{{ $order->status }}</td><td>{{ $order->payment_status }}</td><td><a href="{{ route('admin.orders.show', $order) }}">View</a></td></tr>
        @empty <tr><td colspan="7">No orders yet.</td></tr> @endforelse</tbody>
    </table></div>
    {{ $orders->links() }}
</div>
@endsection
