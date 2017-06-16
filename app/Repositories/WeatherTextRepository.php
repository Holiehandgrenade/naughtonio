<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 6/16/17
 * Time: 12:20 PM
 */

namespace App\Repositories;


class WeatherTextRepository
{
    public function getTimezones()
    {
        return [
            'EST',
            'CST',
            'MST',
            'PST',
        ];
    }
}