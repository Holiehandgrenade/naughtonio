<?php

namespace App\Http\Controllers;

use App\Jobs\AddLatLongFromZipToUser;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    public function show()
    {
        return view('zip.show');
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'zip' => 'required|max:5|min:5',
        ]);

        $user = \Auth::user();

        $user->update([
            'zip' => $request->input('zip')
        ]);

        dispatch(new AddLatLongFromZipToUser($user, $request->input('zip')));

        $url = session()->get('url.intended');
        session()->forget('url.intended');

        return redirect()->to($url);
    }
}
