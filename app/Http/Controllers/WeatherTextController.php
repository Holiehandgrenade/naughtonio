<?php

namespace App\Http\Controllers;

use App\Events\WeatherTextUpdated;
use App\Models\WeatherText\WeatherText;
use Illuminate\Http\Request;
use Auth;

class WeatherTextController extends Controller
{
    /**
     * Returns one of two views to gather needed info
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Updates the User and WeatherText records
     *
     * @param Request $request
     */
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

    /**
     * Updates User phone record
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
