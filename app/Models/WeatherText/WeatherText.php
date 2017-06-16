<?php

namespace App\Models\WeatherText;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WeatherText extends Model
{
    protected $guarded = [];

    protected $dates = ['time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTimeAttribute($time)
    {
        $this->attributes['time'] = Carbon::createFromFormat('H:i', $time, $this->user->timezone)
            ->setTimezone(new \DateTimeZone('UTC'));
    }

    public function getTimeAttribute($time)
    {
        return Carbon::parse($time)
            ->setTimezone(new \DateTimeZone($this->user->timezone))
            ->format('H:i');
    }
}
