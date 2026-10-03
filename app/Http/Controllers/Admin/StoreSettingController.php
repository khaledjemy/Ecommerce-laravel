<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class StoreSettingController extends Controller
{
    public function edit()
    {
        return view('admin.store-settings', ['settings' => StoreSetting::current()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'store_name' => ['required', 'string', 'max:100'],
            'about_text' => ['nullable', 'string', 'max:2000'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'currency' => ['required', 'regex:/^[A-Z]{3}$/'],
            'bank_transfer_instructions' => ['nullable', 'string', 'max:2000'],
        ]);

        foreach (['shipping_enabled', 'pickup_enabled', 'cash_on_delivery_enabled', 'bank_transfer_enabled'] as $key) {
            $data[$key] = $request->boolean($key);
        }
        if (!$data['shipping_enabled'] && !$data['pickup_enabled']) {
            return back()->withErrors(['delivery' => 'Enable at least one delivery method.'])->withInput();
        }
        if (!$data['cash_on_delivery_enabled'] && !$data['bank_transfer_enabled']) {
            return back()->withErrors(['payment' => 'Enable at least one payment method.'])->withInput();
        }
        if ($data['bank_transfer_enabled'] && blank($data['bank_transfer_instructions'])) {
            return back()->withErrors(['bank_transfer_instructions' => 'Add bank transfer instructions before enabling it.'])->withInput();
        }

        StoreSetting::current()->update($data);

        return back()->with('status', 'Store settings saved.');
    }
}
