<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory, HasSlug, HasScope;
    protected $fillable = [
        'name', 'slug', 'image' ,'description', 'quantity', 'unit', 'price', 'category_id', 'warehouse_id'
    ];

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($image) => asset('storage/products/' . $image),
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
}
