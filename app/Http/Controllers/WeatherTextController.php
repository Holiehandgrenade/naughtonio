<?php

namespace App\Http\Controllers;

use App\Events\WeatherTextUpdated;
use App\Repositories\WeatherTextRepository;
use Illuminate\Http\Request;

class WeatherTextController extends Controller
{
    protected $weatherTextRepo;

    public function __construct(WeatherTextRepository $weatherTextRepository)
    {
        $this->weatherTextRepo = $weatherTextRepository;
    }

    /**
     * Returns one of two views to gather needed info
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $user = \Auth::user();

        if ($user->phone == null) {

            // If user doesn't have a phone already, return form
            return view('weathertext.phone');
        } else {

            // Else return regular form
            return view('weathertext.show', [
                'user' => $user,
                'weatherText' => $user->weatherText,
                'timezones' => $this->weatherTextRepo->getTimezones(),
                'times' => $this->weatherTextRepo->getTimes(),
            ]);
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

        return back()->with(['success' => 'Record saved']);
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

        return back();
    }
}
