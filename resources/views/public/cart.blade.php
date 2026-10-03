@extends('public.layouts.main')

@section('content')
<section class="section" style="padding: 170px 0 80px; min-height: 60vh">
    <div class="container">
        <h1 class="mb-4">Your cart</h1>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if ($errors->any()) <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div> @endif
        @if ($cartItems->isEmpty())
            <p>Your cart is empty. <a href="{{ route('products') }}">Browse products</a></p>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th><th></th></tr></thead>
                    <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>@if ($item->product?->published && $item->product?->category?->published)<a href="{{ route('singleproduct', $item->product_id) }}">{{ $item->product->name }}</a>@else Unavailable product @endif</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $item) }}" class="d-flex align-items-center" style="gap:8px">
                                    @csrf @method('PATCH')
                                    <label class="sr-only" for="quantity-{{ $item->id }}">Quantity</label>
                                    <input class="form-control" style="max-width:85px" id="quantity-{{ $item->id }}" type="number" name="quantity" min="1" max="99" value="{{ $item->quantity }}" required>
                                    <button class="btn btn-outline-dark btn-sm" type="submit">Update</button>
                                </form>
                                @if ($item->quantity > ($item->product?->stock ?? 0)) <span class="text-danger">Stock changed</span> @endif
                            </td>
                            <td>{{ $currency }} {{ number_format($item->product?->price ?? 0, 2) }}</td>
                            <td>{{ $currency }} {{ number_format(($item->product?->price ?? 0) * $item->quantity, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $item) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-end fw-bold">Subtotal: {{ $currency }} {{ number_format($total, 2) }}</p>
            <p class="text-end"><a class="btn btn-dark" href="{{ route('checkout.create') }}">Continue to checkout</a></p>
        @endif
    </div>
</section>
@endsection
