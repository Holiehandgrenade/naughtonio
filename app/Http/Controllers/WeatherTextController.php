<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WeatherTextController extends Controller
{
    public function show()
    {
        if (\Auth::user()->phone == null) {
            return view('weathertext.phone');
        } else {
            return view('weathertext.show', ['user' => \Auth::user()]);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'time' => 'required',
            'phone' => 'required',
            'active' => 'required',
            'timezone' => 'required',
        ]);

        $user = Auth::user();

        if ( ! $user->weatherText) {
            Auth::user()->weatherText
        }

        $user->update([
            'phone' => $request->input('phone'),
            'timezone' => $request->input('timezone'),
        ]);
    }

    public function phone(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = \Auth::user();

        $user->update([
            'phone' => $request->input('phone')
        ]);

        return view('weathertext.show', compact('user'));
    }
}
