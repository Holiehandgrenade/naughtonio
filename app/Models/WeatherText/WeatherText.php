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

    public function scopeCurrent($query)
    {
        $now = Carbon::now()->format('H:i');
        return $query->where('time', $now);
    }

    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }
}
