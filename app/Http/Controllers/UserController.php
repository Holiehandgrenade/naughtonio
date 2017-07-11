<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = \Auth::user();

        $this->validate($request, [
            'username' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
            'email' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
        ]);


        $user->fill($request->all());

        $user->save();
    }
}
