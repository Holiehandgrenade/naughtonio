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
     * @return @mixed
     */
    public function update(Request $request)
    {
        $user = \Auth::user();

        $this->validate($request, [
            'username' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
            'email' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
            'password' => 'confirmed'
        ]);

        // If user does not enter correct current password, invalid
        if ($request->has('current_password') && ! \Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $this->userRepo->updateUser($user, $request);

        return back()->with(['success' => 'Record Updated']);
    }
}
