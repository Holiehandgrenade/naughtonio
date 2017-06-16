<?php

namespace App\Models\WeatherText;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WeatherText extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
