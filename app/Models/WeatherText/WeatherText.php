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

    public function getTimeAttribute($time)
    {
        return Carbon::parse($time)
            ->setTimezone(new \DateTimeZone($this->user->timezone))
            ->format('H:i');
    }

    public function scopeWithinFifteenMinutes($query)
    {
        $ago = Carbon::now()->subSeconds(450)->format('H:i');
        $future = Carbon::now()->addSeconds(450)->format('H:i');

        return $query->whereBetween('time', [$ago, $future]);
    }
}
