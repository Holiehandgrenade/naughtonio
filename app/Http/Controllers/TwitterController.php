<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Thujohn\Twitter\Facades\Twitter;

class TwitterController extends Controller
{
    public function tweet(Request $request)
    {
        $status = $request->input('status');
        $timestamp = $request->input('timestamp');
        $code = $request->input('code');

        \Log::info($timestamp);
        \Log::info($code);

//        Twitter::postTweet(['status' => $status]);

        return json_encode(["status" => 200, "message" => "sent tweet"]);
    }
}
