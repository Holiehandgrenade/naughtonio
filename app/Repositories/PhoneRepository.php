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

class PhoneRepository
{
    public function createPhoneVerification(User $user, $phone)
    {
        \DB::table('phone_verifications')
            ->insert([
                'user_id' => $user->id,
                'pending_phone' => $this->stripPhone($phone),
                'verify_code' => rand(100000, 999999),
                'created_at' => Carbon::now()
            ]);
    }

    public function getLatestVerificationForUser(User $user)
    {
        return \DB::table('phone_verifications')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->first();
    }

    public function updateUserPhone(User $user, $verification)
    {
        $user->update([
            'phone' => $verification->pending_phone,
        ]);
    }

    private function stripPhone ($phone) {
        // numeric only
        return preg_replace('/[^0-9]/s', '', $phone);
    }
}