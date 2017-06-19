<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function show()
    {
        return view('phone.show');
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = \Auth::user();

        $user->update([
            'phone' => $request->input('phone'),
        ]);

        $url = session()->get('url.intended');
        session()->forget('url.intended');

        return redirect()->to($url);
    }
}
