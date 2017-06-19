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
                'pending_phone' => $phone,
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
}