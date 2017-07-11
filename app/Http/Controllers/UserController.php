<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
        ]);

        $user = \Auth::user();


    }
}
