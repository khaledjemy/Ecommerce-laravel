<?php

use App\Models\Contact;

it('keeps messages and subscriptions separate and admin-only', function () {
    $customer = cartUser();
    $admin = cartUser();
    $customer->forceFill(['email_verified_at' => now()])->save();
    $admin->forceFill(['is_admin' => true, 'email_verified_at' => now()])->save();

    $this->post(route('store'), [
        'name' => 'Sender', 'email' => 'sender@example.test', 'message' => 'A question',
    ])->assertRedirect(route('contact'));
    $this->post(route('send'), [
        'name' => 'Reader', 'email' => 'reader@example.test',
    ])->assertRedirect(route('contact'));

    expect(Contact::where('kind', 'message')->count())->toBe(1)
        ->and(Contact::where('kind', 'subscription')->count())->toBe(1);
    $this->actingAs($customer)->get(route('admin.inbox.index'))->assertForbidden();
    $this->actingAs($admin)->get(route('admin.inbox.index'))->assertOk()
        ->assertSee('A question')->assertDontSee('reader@example.test');
    $this->actingAs($admin)->get(route('admin.inbox.index', ['kind' => 'subscription']))->assertOk()
        ->assertSee('reader@example.test')->assertDontSee('A question');
});
