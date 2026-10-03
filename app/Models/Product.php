<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
        'price',
        'published',
        'rate',
        'category_id',
        'stock',
    ];
    
    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function imageUrl(): string
    {
        return asset(str_starts_with($this->image, 'assets/')
            ? $this->image
            : 'assests/images/'.basename($this->image));
    }
}
