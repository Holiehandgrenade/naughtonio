<?php

namespace App\Models\WeatherText;

use App\Repositories\WeatherTextRepository;
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

    public function scopeCurrent($query)
    {
        $now = Carbon::now()->format('H:i');
        return $query->where('time', $now);
    }

    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    public function updateAlertTime()
    {
        $repo = new WeatherTextRepository();
        $time = $repo->getUTCTime([
            'time' => $this->local_time,
            'timezone' => $this->user->timezone,
        ]);

        $this->time = $time;
        $this->save();
    }
}
