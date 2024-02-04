<?php

namespace CherryAnt\CountryStateGeo\Facades;

class CountryStateGeo extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \CherryAnt\CountryStateGeo\CountryStateGeo::class;
    }
}
