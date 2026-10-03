<?php

namespace Database\Seeders;

use App\Models\StoreSetting;
use Illuminate\Database\Seeder;
use RuntimeException;

class DemoStoreSeeder extends Seeder
{
    public function run(): void
    {
        if (!config('demo.enabled') || config('database.default') !== 'sqlite') {
            throw new RuntimeException('DemoStoreSeeder requires DEMO_MODE=true and a separate SQLite database.');
        }

        $this->call(DemoCatalogSeeder::class);
        StoreSetting::current()->update([
            'store_name' => 'Ecommerce Demo',
            'about_text' => 'This is a sample storefront. All products and prices are fictional. No orders or payments are accepted.',
            'contact_email' => null,
            'currency' => 'USD',
            'shipping_enabled' => false,
            'pickup_enabled' => true,
            'cash_on_delivery_enabled' => true,
            'bank_transfer_enabled' => false,
            'bank_transfer_instructions' => null,
        ]);
    }
}
