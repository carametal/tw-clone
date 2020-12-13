<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setup();
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
    }
}
