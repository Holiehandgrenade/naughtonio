<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function show()
    {
        $user = \Auth::user();

        return view('account.account', compact('user'));
    }

    /**
     * Updates user record
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $user = \Auth::user();

        $this->validate($request, [
            'username' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
            'email' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
        ]);

        $this->userRepo->updateUser($user, $request);
    }
}
