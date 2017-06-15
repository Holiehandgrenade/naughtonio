<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherTextController extends Controller
{
    public function show()
    {
        if (\Auth::user()->phone == null) {
            return view('weathertext.phone');
        } else {
            return view('weathertext.show');
        }
    }

    public function phone(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);


    }
}
