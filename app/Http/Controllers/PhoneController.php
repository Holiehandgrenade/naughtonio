<?php

namespace App\Http\Controllers;

use App\Jobs\SendPhoneVerificationText;
use App\Repositories\PhoneRepository;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    private $phoneRepo;

    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->phoneRepo = $phoneRepository;
    }

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

        // store a phone_verification record
        $this->phoneRepo->createPhoneVerification($user, $request->input('phone'));

        // text code to phone
        $this->dispatch(new SendPhoneVerificationText($user));

        // redirect to /phone-verify
        return redirect()->to('/phone-verify');
    }
}
