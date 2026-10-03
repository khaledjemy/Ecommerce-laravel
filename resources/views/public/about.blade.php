@extends('public.layouts.main')

@section('content')
<div class="page-heading about-page-heading" id="top">
    <div class="container"><div class="inner-content"><h1>About {{ $settings->store_name }}</h1></div></div>
</div>
<section class="about-us">
    <div class="container">
        <h2>Our store</h2>
        @if ($settings->about_text)
            <p style="white-space:pre-line">{{ $settings->about_text }}</p>
        @else
            <p>Store details will be added by the owner.</p>
        @endif
        <p><a href="{{ route('products') }}">Explore products</a> · <a href="{{ route('contact') }}">Contact us</a></p>
    </div>
</section>
@include('public.includes.subscribe')
@endsection
