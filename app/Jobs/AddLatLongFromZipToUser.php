<?php

namespace App\Jobs;

use App\Exceptions\ZipToLatLonFailedException;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Geocode;
use \Exception;

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
     * @throws ZipToLatLonFailedException
     */
    public function handle()
    {
        try {
            $geo = Geocode::make()->address($this->zip);

            if ( ! $geo) {
                throw new ZipToLatLonFailedException();
            }

            $this->user->update([
                'latitude' => $geo->latitude(),
                'longitude' => $geo->longitude(),
            ]);
        } catch (Exception $exception) {
            throw new ZipToLatLonFailedException();
        };
    }
}
