<?php

namespace App\Models;

use App\Traits\HasScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasScope;
    protected $fillable = [
        'invoice', 'grand_total' ,'user_id', 'payment_status', 'midtrans_url', 'midtrans_booking_code'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function details(){
        return $this->hasMany(TransactionDetail::class);
    }
}
