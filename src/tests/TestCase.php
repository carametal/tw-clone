<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
