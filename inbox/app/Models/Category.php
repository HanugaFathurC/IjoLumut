<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory, HasSlug, HasScope;
    protected $fillable = [
        'name', 'slug', 'image'
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/categories/' . $image),
        );
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
