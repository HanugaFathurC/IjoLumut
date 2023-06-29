<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticLog extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function analyticDetails()
    {
        return $this->hasMany(AnalyticDetail::class);
    }
}
