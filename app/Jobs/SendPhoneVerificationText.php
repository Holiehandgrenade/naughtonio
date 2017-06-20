<?php

namespace App\Jobs;

use App\Repositories\PhoneRepository;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Nexmo\Laravel\Facade\Nexmo;

class SendPhoneVerificationText implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phoneRepo, $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phoneRepo = new PhoneRepository();
        $verification = $phoneRepo->getLatestVerificationForUser($this->user);

        Nexmo::message()->send([
            'to' => $verification->pending_calling_code . $verification->pending_phone,
            'from' => getenv('NEXMO_PHONE_NUMBER'),
            'text' => 'naughton.io verification number: ' . $verification->verify_code
        ]);
    }
}
