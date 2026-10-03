<?php

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\DemoCatalogSeeder;

it('builds a repeatable catalog of sample products without using customer data', function () {
    $this->seed(DemoCatalogSeeder::class);
    $this->seed(DemoCatalogSeeder::class);

    expect(Category::count())->toBe(3);
    expect(Product::count())->toBe(9);
    $this->get('/')->assertOk()->assertSee('Classic jacket');
    $this->get('/products')->assertOk()->assertSee('Classic jacket');
    expect(Product::firstOrFail()->imageUrl())->toContain('/assets/images/');
});
