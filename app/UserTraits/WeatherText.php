<?php

namespace App\UserTraits;

/**
 * Created by PhpStorm.
 * User: jack
 * Date: 6/15/17
 * Time: 2:12 PM
 */
trait WeatherText
{
    protected function weatherText ()
    {
        return $this->hasOne(\App\Models\WeatherText\WeatherText::class);
    }
}