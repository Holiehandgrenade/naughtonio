<?php

namespace App\Jobs;

use App\Events\PhoneVerificationSendingFailed;
use App\Exceptions\VerificationTextFailedException;
use App\Repositories\PhoneRepository;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use \Exception;
use Nexmo\Laravel\Facade\Nexmo;

class SendPhoneVerificationText implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phoneRepo, $user, $verification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->phoneRepo = new PhoneRepository();
        $this->verification = $this->phoneRepo->getLatestVerificationForUser($this->user);
    }

    /**
     * Execute the job.
     *
     *
     */
    public function handle()
    {
        try {
            Nexmo::message()->send([
                'to' => $this->verification->pending_calling_code . $this->verification->pending_phone,
                'from' => getenv('NEXMO_PHONE_NUMBER'),
                'text' => 'naughton.io verification number: ' . $this->verification->verify_code
            ]);
        } catch (\Exception $exception) {
            throw new VerificationTextFailedException();
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed(Exception $exception)
    {
        \Log::info('failed');
        event(new PhoneVerificationSendingFailed($this->verification));
    }
}
