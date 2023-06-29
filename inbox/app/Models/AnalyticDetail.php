<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticDetail extends Model
{
    use HasFactory;

    protected $fillable = ['analytic_log_id', 'order_id', 'final_score', 'rank'];

    public function analyticLog()
    {
        return $this->belongsTo(AnalyticLog::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
