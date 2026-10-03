@extends('admin.layouts.main')

@section('content')
<div class="right_col" role="main">
    <h1>Order #{{ $order->id }}</h1>
    @if (session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
    @if ($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
    <p><strong>Customer:</strong> {{ $order->customer_name }} · {{ $order->phone }}</p>
    <p><strong>Delivery:</strong> {{ $order->delivery_method }} · {{ $order->address }}</p>
    <p><strong>Payment method:</strong> {{ $order->payment_method }}</p>
    @if ($order->notes) <p><strong>Notes:</strong> {{ $order->notes }}</p> @endif
    <table class="table"><thead><tr><th>Product</th><th>Quantity</th><th>Unit price</th><th>Total</th></tr></thead><tbody>
        @foreach ($order->items as $item)<tr><td>{{ $item->product_name }}</td><td>{{ $item->quantity }}</td><td>{{ $order->currency }} {{ number_format($item->unit_price, 2) }}</td><td>{{ $order->currency }} {{ number_format($item->line_total, 2) }}</td></tr>@endforeach
    </tbody></table>
    <p><strong>Subtotal:</strong> {{ $order->currency }} {{ number_format($order->subtotal, 2) }}</p>
    <p>Check receipt outside this system before marking an order paid. No payment gateway verification is connected.</p>
    <h2>History</h2>
    <ul>@foreach ($order->events as $event)<li>{{ $event->created_at }} — {{ $event->actor?->username ?? 'Former user' }}: {{ $event->from_status ?? 'created' }} → {{ $event->to_status }}, {{ $event->from_payment_status ?? 'created' }} → {{ $event->to_payment_status }}</li>@endforeach</ul>
    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
        @csrf @method('PUT')
        <label for="status">Order status</label>
        <select id="status" name="status" class="form-control">@foreach (['pending', 'confirmed', 'fulfilled', 'cancelled'] as $status)<option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>@endforeach</select>
        <label for="payment_status">Payment status</label>
        <select id="payment_status" name="payment_status" class="form-control">@foreach (['unpaid', 'paid'] as $status)<option value="{{ $status }}" @selected($order->payment_status === $status)>{{ ucfirst($status) }}</option>@endforeach</select>
        <button class="btn btn-primary" type="submit">Save order</button>
    </form>
</div>
@endsection
