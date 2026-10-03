<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = [
        'store_name', 'about_text', 'contact_email', 'currency', 'shipping_enabled', 'pickup_enabled',
        'cash_on_delivery_enabled', 'bank_transfer_enabled',
        'bank_transfer_instructions',
    ];

    protected function casts(): array
    {
        return [
            'shipping_enabled' => 'boolean',
            'pickup_enabled' => 'boolean',
            'cash_on_delivery_enabled' => 'boolean',
            'bank_transfer_enabled' => 'boolean',
        ];
    }

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'store_name' => 'Ecommerce Store',
            'currency' => 'USD',
            'shipping_enabled' => true,
            'pickup_enabled' => true,
            'cash_on_delivery_enabled' => true,
            'bank_transfer_enabled' => false,
        ]);
    }

    public function deliveryMethods(): array
    {
        return array_filter([
            'shipping' => $this->shipping_enabled ? 'Shipping' : null,
            'pickup' => $this->pickup_enabled ? 'Pickup' : null,
        ]);
    }

    public function paymentMethods(): array
    {
        return array_filter([
            'cash_on_delivery' => $this->cash_on_delivery_enabled ? 'Cash on delivery / pickup' : null,
            'bank_transfer' => $this->bank_transfer_enabled && filled($this->bank_transfer_instructions)
                ? 'Bank transfer' : null,
        ]);
    }
}
