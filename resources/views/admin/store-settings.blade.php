@extends('admin.layouts.main')

@section('content')
<div class="right_col" role="main">
    <h1>Store settings</h1>
    <p>These settings apply to this installation. Online gateways require a separate provider integration and are not enabled here.</p>
    @if (session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
    @if ($errors->any()) <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('admin.store-settings.update') }}">
        @csrf
        @method('PUT')
        <div class="form-group"><label for="store_name">Store name</label><input class="form-control" id="store_name" name="store_name" value="{{ old('store_name', $settings->store_name) }}" required></div>
        <div class="form-group"><label for="about_text">About the store</label><textarea class="form-control" id="about_text" name="about_text" rows="4">{{ old('about_text', $settings->about_text) }}</textarea></div>
        <div class="form-group"><label for="contact_email">Public contact email (optional)</label><input class="form-control" id="contact_email" name="contact_email" type="email" value="{{ old('contact_email', $settings->contact_email) }}"></div>
        <div class="form-group"><label for="currency">Currency (ISO 4217 code)</label><input class="form-control" id="currency" name="currency" maxlength="3" value="{{ old('currency', $settings->currency) }}" required></div>
        <fieldset><legend>Delivery methods</legend>
            <label><input type="checkbox" name="shipping_enabled" value="1" @checked(old('shipping_enabled', $settings->shipping_enabled))> Shipping</label><br>
            <label><input type="checkbox" name="pickup_enabled" value="1" @checked(old('pickup_enabled', $settings->pickup_enabled))> Pickup</label>
        </fieldset>
        <fieldset><legend>Payment methods</legend>
            <label><input type="checkbox" name="cash_on_delivery_enabled" value="1" @checked(old('cash_on_delivery_enabled', $settings->cash_on_delivery_enabled))> Cash on delivery / pickup</label><br>
            <label><input type="checkbox" name="bank_transfer_enabled" value="1" @checked(old('bank_transfer_enabled', $settings->bank_transfer_enabled))> Bank transfer</label>
        </fieldset>
        <div class="form-group"><label for="bank_transfer_instructions">Bank transfer instructions shown after ordering</label><textarea class="form-control" id="bank_transfer_instructions" name="bank_transfer_instructions" rows="4">{{ old('bank_transfer_instructions', $settings->bank_transfer_instructions) }}</textarea></div>
        <button type="submit" class="btn btn-primary">Save settings</button>
    </form>
</div>
@endsection
