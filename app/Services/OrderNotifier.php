<?php

namespace App\Services;

use App\Mail\OrderPlaced;
use App\Mail\OrderUpdated;
use App\Models\Order;
use App\Models\StoreSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderNotifier
{
    public function placed(Order $order): void
    {
        try {
            Mail::to($order->user->email)->queue(new OrderPlaced($order));
            $storeEmail = StoreSetting::current()->contact_email;
            if ($storeEmail && $storeEmail !== $order->user->email) {
                Mail::to($storeEmail)->queue(new OrderPlaced($order, true));
            }
        } catch (\Throwable $exception) {
            Log::error('Order notification could not be queued.', [
                'order_id' => $order->id,
                'exception' => $exception,
            ]);
        }
    }

    public function updated(Order $order): void
    {
        try {
            Mail::to($order->user->email)->queue(new OrderUpdated($order));
        } catch (\Throwable $exception) {
            Log::error('Order update notification could not be queued.', [
                'order_id' => $order->id,
                'exception' => $exception,
            ]);
        }
    }
}
