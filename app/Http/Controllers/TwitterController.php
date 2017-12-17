<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function tweet(Request $request, $tweet)
    {
        \Log::info($tweet);
    }
}
