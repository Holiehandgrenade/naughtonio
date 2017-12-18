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

        $split = str_split($timestamp);
        \Log::info($split);
        foreach($split as $key => $num) {
            $split[$key] = ord($num);
        }
        \Log::info($split);

        if ($code == implode($split)) {
            Twitter::postTweet(['status' => $status]);

            return json_encode(["status" => 200, "message" => "sent tweet"]);
        }
        \Log::info($code);
        \Log::info(implode($split));

        return json_encode(["status" => 400, "message" => "bad code"]);
    }
}
