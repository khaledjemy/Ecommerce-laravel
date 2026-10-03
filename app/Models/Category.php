<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_name',
        'image',
        'description',
        'published',
    ];
    
    public function products()
    {
       return $this->hasMany(Product::class);
    }

    public function imageUrl(): string
    {
        return asset(str_starts_with($this->image, 'assets/')
            ? $this->image
            : 'assests/images/'.basename($this->image));
    }
}
