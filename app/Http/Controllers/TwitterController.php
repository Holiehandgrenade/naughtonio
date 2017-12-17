<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitter;

class TwitterController extends Controller
{
    public function tweet(Request $request)
    {
        $status = $request->input('status');

        Twitter::postTweet(['status' => $status]);

        return json_encode(["status" => 200, "message" => "sent tweet"]);
    }
}
