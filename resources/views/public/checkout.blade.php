@extends('public.layouts.main')

@section('content')
<section class="section" style="padding: 170px 0 80px; min-height: 60vh">
    <div class="container">
        <h1>Checkout</h1>
        <p>Subtotal: {{ $settings->currency }} {{ number_format($items->sum(fn ($item) => $item->product->price * $item->quantity), 2) }}. Shipping fees, if any, will be confirmed before fulfillment. No online payment is collected here.</p>
        @if ($errors->any()) <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div> @endif
        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="mb-3"><label for="customer_name">Full name</label><input class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required></div>
            <div class="mb-3"><label for="phone">Phone</label><input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required></div>
            <fieldset class="mb-3"><legend>Delivery</legend>
                @foreach ($settings->deliveryMethods() as $key => $label)
                    <label class="ms-3"><input type="radio" name="delivery_method" value="{{ $key }}" @checked(old('delivery_method', array_key_first($settings->deliveryMethods())) === $key)> {{ $label }}</label>
                @endforeach
            </fieldset>
            <div class="mb-3"><label for="address">Shipping address (required for shipping)</label><input class="form-control" id="address" name="address" value="{{ old('address') }}"></div>
            <fieldset class="mb-3"><legend>Payment</legend>
                @foreach ($settings->paymentMethods() as $key => $label)
                    <label class="ms-3"><input type="radio" name="payment_method" value="{{ $key }}" @checked(old('payment_method', array_key_first($settings->paymentMethods())) === $key)> {{ $label }}</label>
                @endforeach
                <p class="text-muted">Cards and wallets are unavailable until a payment provider is connected.</p>
            </fieldset>
            <div class="mb-3"><label for="notes">Notes (optional)</label><textarea class="form-control" id="notes" name="notes">{{ old('notes') }}</textarea></div>
            <button type="submit" class="btn btn-dark">Place unpaid order</button>
        </form>
    </div>
</section>
@endsection
