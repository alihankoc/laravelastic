<?php


namespace AlihanKoc\Laravelastic;


use Illuminate\Support\Facades\Facade;

class Elastic extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AlihanKoc\Laravelastic\Contracts\Elastic';
    }
}
