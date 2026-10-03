<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('store:grant-admin {email}', function (string $email) {
    $user = User::where('email', $email)->firstOrFail();
    if (!$user->hasVerifiedEmail()) {
        $this->error('Verify the user email before granting admin access.');
        return 1;
    }
    $user->forceFill(['is_admin' => true])->save();
    $this->info("Admin access granted to {$user->email}.");
})->purpose('Grant catalog administration to an existing verified store user');
