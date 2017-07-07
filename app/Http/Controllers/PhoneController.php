<?php

namespace App\Http\Controllers;

use App\Jobs\SendPhoneVerificationText;
use App\Repositories\PhoneRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class PhoneController extends Controller
{
    private $phoneRepo;
    private $codeExpirationMinutes = 5;

    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->phoneRepo = $phoneRepository;
    }

    /**
     * Show enter phone page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('phone.show');
    }

    /**
     * Creates phone verification record and texts code to phone
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|max:10|min:10',
        ]);

        $user = \Auth::user();

        // store a phone_verification record
        $this->phoneRepo->createPhoneVerification($user, $request->input('phone'));

        // text code to phone
        dispatch(new SendPhoneVerificationText($user));

        // redirect to /phone-verify
        Session::flash('message', 'A verification code has been sent to this number.');
        return redirect()->to('/phone-verify');
    }

    /**
     * Show enter verification code page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVerify()
    {
        $phoneVerification = json_encode($this->phoneRepo->getLatestVerificationForUser(\Auth::user()));
        return view('phone.show-verify', compact('phoneVerification'));
    }

    /**
     * Checks if code is valid
     *
     * @param Request $request
     * @return @mixed
     */
    public function postVerify(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = \Auth::user();

        $verification = $this->phoneRepo->getLatestVerificationForUser($user);

        // Expired
        if (Carbon::now()->diffInMinutes(Carbon::parse($verification->created_at)) > $this->codeExpirationMinutes) {
            // redirect to /phone with message and fill with pending phone
            Session::flash('phone', $verification->pending_phone);
            return redirect()->to('/phone')
                ->withErrors(['code' => 'This code has expired. Please submit again for another.']);
        }

        // Correct
        if ($verification->verify_code == $request->input('code')) {
            // verify users phone and add to record
            $this->phoneRepo->updateUserPhone($user, $verification);

            // redirect to intended url
            return redirect()->to(session()->get('url.intended'));
        }

        // Incorrect
        if ($verification->verify_code != $request->input('code')) {
            // return back with errors
            return redirect()->back()->withErrors(['code' => 'The code did not match the most recent code sent.']);
        }

        // Internal Error. Return to /phone with errors
        Session::flash('phone', $verification->pending_phone);
        return redirect()->to('/phone')
            ->withErrors(['code' => 'Internal error, please try again.']);
    }

    /**
     * Handles inbound text messages
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function inbound(Request $request)
    {
        if ($request->input('keyword') == 'STOP') {
            $this->phoneRepo->handleStopRequest($request);
        }

        return \Response::json([], 200);
    }
}
