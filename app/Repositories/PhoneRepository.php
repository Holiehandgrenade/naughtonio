<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 6/19/17
 * Time: 1:27 PM
 */

namespace App\Repositories;


use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhoneRepository
{
    public function createPhoneVerification(User $user, $phone)
    {
        \DB::table('phone_verifications')
            ->insert([
                'user_id' => $user->id,
                'pending_phone' => $phone,
                'verify_code' => rand(100000, 999999),
                'created_at' => Carbon::now()
            ]);
    }

    public function getLatestVerificationForUser(User $user)
    {
        return $user->phoneVerifications()
            ->orderByDesc('created_at')
            ->first();
//        return \DB::table('phone_verifications')
//            ->where('user_id', $user->id)
//            ->orderByDesc('created_at')
//            ->first();
    }

    public function updateUserPhone(User $user, $verification)
    {
        $user->update([
            'phone' => $verification->pending_phone,
            'calling_code' => $verification->pending_calling_code,
        ]);
    }

    public function handleStopRequest(Request $request)
    {
        // syntax of a "stop request" should be "stop [app_keyword]"
        // therefore, index [1] should be the keyword after explode
        $app = strtolower(explode(' ', $request->input('text'))[1]);
        // remove calling code from phone
        $phone = substr($request->input('msisdn'), 1);

        switch ($app) {
            case 'weather':
                $this->deactivateWeatherTextRecord($phone);
                break;
        }
    }

    private function deactivateWeatherTextRecord($phone)
    {
        $user = User::wherePhone($phone)->first();
        $user->weatherText->update(['active' => false]);
    }
}