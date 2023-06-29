<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Type extends Model
{
    use HasFactory, HasSlug, HasScope;
    protected $fillable = [
        'name', 'slug', 'image'
    ];

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($image) => asset('storage/types/' . $image),
        );
    }

    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }
}
