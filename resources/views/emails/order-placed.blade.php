<h1>Order #{{ $order->id }}</h1>
<p>{{ $forStore ? 'A new order was placed.' : 'We received your order.' }}</p>
<p>Status: {{ $order->status }}. Payment: {{ $order->payment_status }}.</p>
<ul>@foreach ($order->items as $item)<li>{{ $item->product_name }} × {{ $item->quantity }} — {{ $order->currency }} {{ number_format($item->line_total, 2) }}</li>@endforeach</ul>
<p>Subtotal: {{ $order->currency }} {{ number_format($order->subtotal, 2) }}</p>
<p>Shipping fees, if applicable, are not included yet. This message is not a payment receipt.</p>
