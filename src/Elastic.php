<?php


namespace AlihanKoc\Elastic;


use Illuminate\Support\Facades\Facade;

class Elastic extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AlihanKoc\Elastic\Contracts\Elastic';
    }
}
