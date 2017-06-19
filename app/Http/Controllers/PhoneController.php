<?php

namespace App\Http\Controllers;

use App\Jobs\SendPhoneVerificationText;
use App\Repositories\PhoneRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    private $phoneRepo;
    private $codeExpirationMinutes = 5;

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

        // append US global code
        $phone = '1' . $request->input('phone');

        // store a phone_verification record
        $this->phoneRepo->createPhoneVerification($user, $phone);

        // text code to phone
        $this->dispatch(new SendPhoneVerificationText($user));

        // redirect to /phone-verify
        return redirect()->to('/phone-verify');
    }

    public function showVerify()
    {
        return view('phone.show-verify');
    }

    public function postVerify(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = \Auth::user();

        $verification = $this->phoneRepo->getLatestVerificationForUser($user);

        // Correct
        if ($verification->verify_code == $request->input('code')) {
            // verify users phone and add to record
            $this->phoneRepo->updateUserPhone($user, $verification);

            // redirect to intended url
            $url = session()->get('url.intended');
            session()->forget('url.intended');
            return redirect()->to($url);
        }

        // Incorrect
        if ($verification->verify_code != $request->input('code')) {
            // return back with errors
        }

        // Expired
        if (Carbon::now()->diffInMinutes(Carbon::parse($verification->created_at)) > $this->codeExpirationMinutes) {
            // redirect to /phone with message
        }

        // Internal Error. Return to /phone with errors
    }
}
