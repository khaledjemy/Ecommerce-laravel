<h1>Order #{{ $order->id }} updated</h1>
<p>Status: {{ $order->status }}. Payment: {{ $order->payment_status }}.</p>
<p>Subtotal: {{ $order->currency }} {{ number_format($order->subtotal, 2) }}</p>
<p>This message is not a payment receipt.</p>
