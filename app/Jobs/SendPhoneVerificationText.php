<?php

namespace App\Jobs;

use App\Events\PhoneVerificationSendingFailed;
use App\Exceptions\VerificationTextFailedException;
use App\Notifications\GenericTextMessage;
use App\Repositories\PhoneRepository;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use \Exception;

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
            $message = 'naughton.io verification number: ' . $this->verification->verify_code;
            $this->verification->notify(new GenericTextMessage($message));

        } catch (\Exception $exception) {
            \Log::info('************************ Verification Text Failed ************************');
            \Log::info($exception->getMessage());
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
        event(new PhoneVerificationSendingFailed($this->verification));
    }
}
