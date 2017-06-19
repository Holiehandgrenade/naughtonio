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
                'phone' => $phone,
                'verify_code' => rand(100000, 999999),
                'created_at' => Carbon::now()
            ]);
    }

}