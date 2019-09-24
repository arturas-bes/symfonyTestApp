<?php


namespace App\Services;

class MySecondService implements ServiceInterface
{
    public function __construct()
    {
        dump('from second service');


    }

    public function someMethod()
    {

        return 'Hello';
    }
}