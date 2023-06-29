<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasScope;
    use SoftDeletes;

    protected $fillable = ['name', 'quantity', 'duration', 'price', 'status', 'image', 'unit', 'user_id'];

    protected $casts = [
        'status' => OrderStatus::class
    ];

    protected $dates = ['deleted_at'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => asset('storage/orders/' . $image),
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
