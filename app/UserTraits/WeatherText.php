<?php

/**
 * Created by PhpStorm.
 * User: jack
 * Date: 6/15/17
 * Time: 2:12 PM
 */
trait WeatherText
{
    protected function createWeatherText ($time, $active)
    {
        DB::insert([
            'user_id' => $this->id,
            'time' => $time,
            'active' => $active,
        ]);
    }
}