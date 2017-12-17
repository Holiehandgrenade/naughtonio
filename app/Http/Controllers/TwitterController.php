<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function tweet($tweet)
    {
        \Log::info($tweet);
    }
}
