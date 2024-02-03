<?php

namespace Cherryant\CountryStateGeo\Tests;
use Orchestra\Testbench\TestCase;
use Cherryant\CountryStateGeo\CountryStateGeoProvider;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            CountryStateGeoProvider::class,
        ];
    }
}