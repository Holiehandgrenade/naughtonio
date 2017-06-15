<?php

namespace App\Http\Controllers;

use App\Events\WeatherTextUpdated;
use App\Models\WeatherText\WeatherText;
use Illuminate\Http\Request;
use Auth;

class WeatherTextController extends Controller
{
    public function show()
    {
        // If user doesn't have a phone already, return form
        if (\Auth::user()->phone == null) {
            return view('weathertext.phone');
        } else {
            // Else return regular form
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

        event(new WeatherTextUpdated($request->all()));
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
