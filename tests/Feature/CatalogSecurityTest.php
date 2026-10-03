<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

function catalogUser(bool $isAdmin = false): User
{
    $user = User::create([
        'firstname' => 'Demo',
        'lastname' => 'User',
        'username' => 'demo-'.uniqid(),
        'email' => uniqid().'@example.test',
        'password' => 'password123',
    ]);
    $user->forceFill([
        'email_verified_at' => now(),
        'active' => '1',
        'is_admin' => $isAdmin,
    ])->save();

    return $user;
}

it('does not allow anonymous catalog mutations', function () {
    $this->postJson('/api/products', [])->assertUnauthorized();
    $this->deleteJson('/api/products/1')->assertUnauthorized();
    $this->postJson('/api/categories', [])->assertUnauthorized();
    $this->deleteJson('/api/categories/1')->assertUnauthorized();
});

it('does not allow ordinary customers to manage the catalog or list all users', function () {
    Sanctum::actingAs(catalogUser());

    $this->postJson('/api/products', [])->assertForbidden();
    $this->deleteJson('/api/categories/1')->assertForbidden();
    $this->getJson('/api/usercollection')->assertForbidden();
});

it('hides unpublished products from the storefront', function () {
    $category = Category::create([
        'category_name' => 'men',
        'description' => 'Demo category',
        'image' => 'category.jpg',
        'published' => true,
    ]);
    $visible = Product::create([
        'name' => 'Visible item',
        'price' => 25,
        'rate' => 5,
        'image' => 'visible.jpg',
        'published' => true,
        'stock' => 10,
        'category_id' => $category->id,
    ]);
    $hidden = Product::create([
        'name' => 'Hidden item',
        'price' => 30,
        'rate' => 4,
        'image' => 'hidden.jpg',
        'published' => false,
        'stock' => 10,
        'category_id' => $category->id,
    ]);

    $this->get('/')->assertOk()->assertSee('Visible item')->assertDontSee('Hidden item');
    $this->get('/single-product/'.$visible->id)->assertOk();
    $this->get('/single-product/'.$hidden->id)->assertNotFound();
    $this->getJson('/api/products')->assertOk()->assertSee('Visible item')->assertDontSee('Hidden item');
    $this->getJson('/api/products/'.$hidden->id)->assertDontSee('Hidden item');
    $this->get('/products?q=Visible')->assertOk()->assertSee('Visible item')->assertDontSee('Hidden item');
});
