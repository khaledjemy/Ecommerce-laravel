@extends('public.layouts.main')

@section('content')
<section class="section" style="padding: 170px 0 80px; min-height: 60vh">
    <div class="container">
        <h1>Order #{{ $order->id }}</h1>
        <p>Status: {{ $order->status }} · Payment: {{ $order->payment_status }}</p>
        <ul>@foreach ($order->items as $item)<li>{{ $item->product_name }} × {{ $item->quantity }} — {{ number_format($item->line_total, 2) }}</li>@endforeach</ul>
        <p>Subtotal: {{ $order->currency }} {{ number_format($order->subtotal, 2) }}</p>
        @if ($order->payment_method === 'bank_transfer')
            <h2>Bank transfer instructions</h2>
            <p>{{ \App\Models\StoreSetting::current()->bank_transfer_instructions ?: 'Contact the seller for transfer details.' }}</p>
        @endif
        <p>We will confirm shipping costs and the next steps before fulfillment. This page does not confirm payment.</p>
        <a href="{{ route('products') }}">Continue browsing</a>
    </div>
</section>
@endsection
