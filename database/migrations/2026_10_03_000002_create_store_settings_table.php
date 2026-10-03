<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_name')->default('Ecommerce Store');
            $table->text('about_text')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('currency', 3)->default('USD');
            $table->boolean('shipping_enabled')->default(true);
            $table->boolean('pickup_enabled')->default(true);
            $table->boolean('cash_on_delivery_enabled')->default(true);
            $table->boolean('bank_transfer_enabled')->default(false);
            $table->text('bank_transfer_instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};
