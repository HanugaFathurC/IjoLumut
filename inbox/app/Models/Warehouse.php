<?php

namespace App\Models;

use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class Warehouse extends Model
{
    use HasFactory, HasScope;
    protected $fillable = [
        'name', 'indonesia_provinces_id', 'indonesia_cities_id', 'indonesia_districts_id', 'indonesia_villages_id', 'address', 'telp', 'capacity', 'storage', 'image', 'type_id'
    ];

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($image) => asset('storage/warehouses/' . $image),
        );
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function city(){
        return $this->belongsTo(City::class, 'indonesia_cities_id');
    }

    public function province(){
        return $this->belongsTo(Province::class, 'indonesia_provinces_id');
    }

    public function district(){
        return $this->belongsTo(District::class, 'indonesia_districts_id');
    }

    public function village(){
        return $this->belongsTo(Village::class, 'indonesia_villages_id');
    }
}
