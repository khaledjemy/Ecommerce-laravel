@extends('public.layouts.main')

@section('content')
<div class="page-heading about-page-heading" id="top"><div class="container"><div class="inner-content"><h1>Contact {{ $settings->store_name }}</h1></div></div></div>
<section class="contact-us">
    <div class="container"><div class="row">
        <div class="col-lg-6">
            <h2>Send us a message</h2>
            <p>Use this form to send a question to the store.</p>
            @if ($settings->contact_email)<p>Or email <a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>.</p>@endif
        </div>
        <div class="col-lg-6">
            @if (session('status')) <div class="alert alert-success" role="status">{{ session('status') }}</div> @endif
            @if ($errors->any()) <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div> @endif
            @unless (config('demo.enabled'))
            <form id="contact" action="{{ route('store') }}" method="post">
                @csrf
                <div class="form-group"><label for="contact-name">Name</label><input class="form-control" id="contact-name" name="name" value="{{ old('name') }}" required></div>
                <div class="form-group"><label for="contact-email">Email</label><input class="form-control" id="contact-email" name="email" type="email" value="{{ old('email') }}" required></div>
                <div class="form-group"><label for="contact-message">Message</label><textarea class="form-control" id="contact-message" name="message" rows="6" required>{{ old('message') }}</textarea></div>
                <button type="submit" class="btn btn-dark">Send message</button>
            </form>
            @else <p>This read-only preview does not accept messages.</p> @endunless
        </div>
    </div></div>
</section>
@include('public.includes.subscribe')
@endsection
