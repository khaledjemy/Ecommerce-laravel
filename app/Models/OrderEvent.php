<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderEvent extends Model
{
    protected $guarded = [];

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
