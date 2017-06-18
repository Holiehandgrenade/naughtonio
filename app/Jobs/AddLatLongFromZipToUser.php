<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddLatLongFromZipToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $zip;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $zip)
    {
        $this->user = $user;
        $this->zip = $zip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $geo = Geocode::make()->address($zip);
        
    }
}
