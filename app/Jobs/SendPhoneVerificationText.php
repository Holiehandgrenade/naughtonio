<?php

namespace App\Jobs;

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
     *
     */
    public function handle()
    {
        try {
            $phoneRepo = new PhoneRepository();
            $verification = $phoneRepo->getLatestVerificationForUser($this->user);

            Nexmo::message()->send([
                'to' => $verification->pending_calling_code . $verification->pending_phone,
                'from' => getenv('NEXMO_PHONE_NUMBER') . 23432432,
                'text' => 'naughton.io verification number: ' . $verification->verify_code
            ]);
        } catch (Exception $exception) {
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
        return redirect()->to('/phone')
            ->withErrors(['code' => 'There was an error sending the verification text. Please try again.']);
    }
}
