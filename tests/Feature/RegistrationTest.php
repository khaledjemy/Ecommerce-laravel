<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

it('creates an active customer and starts email verification through the API', function () {
    Event::fake([Registered::class]);

    $this->postJson('/api/register', [
        'firstname' => 'New',
        'lastname' => 'Customer',
        'username' => 'newcustomer',
        'email' => 'new@example.test',
        'password' => 'password123',
    ])->assertOk();

    $user = User::where('email', 'new@example.test')->firstOrFail();
    expect($user->active)->toBe('1')
        ->and($user->hasVerifiedEmail())->toBeFalse()
        ->and($user->is_admin)->toBeFalse();
    Event::assertDispatched(Registered::class);
    $this->actingAs($user)->get(route('checkout.create'))->assertRedirect(route('verification.notice'));
});
