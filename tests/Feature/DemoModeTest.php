<?php

use App\Models\Contact;

it('shows sample storefront but blocks all writes in demo mode', function () {
    config()->set('demo.enabled', true);
    $this->seed(\Database\Seeders\DemoStoreSeeder::class);

    $this->get('/')->assertOk()->assertSee('Demo preview')->assertSee('Classic jacket')
        ->assertDontSee('Add to Cart');
    $this->get('/products')->assertOk()->assertSee('Classic jacket');
    $this->get('/contact')->assertOk()->assertSee('does not accept messages');
    $this->get('/admin/orders')->assertNotFound();
    $this->get('/register')->assertNotFound();
    $this->post('/contact', [
        'name' => 'Spam', 'email' => 'spam@example.test', 'message' => 'Not saved',
    ])->assertForbidden();
    $this->postJson('/api/products', [])->assertForbidden();
    expect(Contact::count())->toBe(0);
});
