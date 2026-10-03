<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;

it('renders store identity and configured currency without template contact details', function () {
    StoreSetting::current()->update([
        'store_name' => 'Sample Store',
        'currency' => 'EUR',
        'about_text' => 'Independent shop description.',
    ]);
    $category = Category::create([
        'category_name' => 'men',
        'description' => 'Men',
        'image' => 'assets/images/men-01.jpg',
        'published' => true,
    ]);
    $product = Product::create([
        'name' => 'Sample Shirt',
        'price' => 25,
        'rate' => 0,
        'image' => 'assets/images/men-01.jpg',
        'published' => true,
        'stock' => 10,
        'category_id' => $category->id,
    ]);

    $this->get(route('index'))->assertOk()->assertSee('Sample Store')->assertSee('EUR 25.00')->assertDontSee('Sunny Isles');
    $this->get(route('products'))->assertOk()->assertSee('EUR 25.00');
    $this->get(route('singleproduct', $product))->assertOk()->assertSee('EUR 25.00');
    $this->get(route('about'))->assertOk()->assertSee('Independent shop description.');
    $this->get(route('contact'))->assertOk()->assertDontSee('info@company.com');
});
