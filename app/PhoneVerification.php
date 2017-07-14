<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @return string
     */
    public function routeNotificationForNexmo()
    {
        return $this->pending_calling_code . $this->pending_phone;
    }
}
