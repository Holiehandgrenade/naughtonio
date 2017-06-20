<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()
        );
    }

    /**
     * Asserts that Jobs are in Queue to be dispatched.
     *
     * @param array|string $queued
     */
    public function assertQueued($queued) {
        if (!is_array($queued))
            $queued = func_get_args();

        $repository = app()->make(
            \Illuminate\Contracts\Queue\Queue::class
        );

        foreach ($queued as $item) {
            $job = $repository->pop('dusk-queue');
            $this->assertTrue($job->resolveName() == $item);
        }
    }
}
