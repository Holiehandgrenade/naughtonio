<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 7/11/17
 * Time: 11:24 AM
 */

namespace App\Repositories;


use App\User;
use Illuminate\Http\Request;

class UserRepository
{
    public function updateUser(User $user, Request $request)
    {
        $user->fill($request->except([
            'password', 'password_confirmation', 'current_password'
        ]));

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
    }
}