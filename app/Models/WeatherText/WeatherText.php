<?php

namespace App\Models\WeatherText;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WeatherText extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTimeAttribute($time)
    {
        $this->attributes['time'] = Carbon::createFromFormat('h:i', $time);
    }
}
