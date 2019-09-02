<?php


namespace App\Services;

use App\Services\MySecondService;

trait OptionalServiceTrait
{
    private $service;


    /**
     * @required
     * @param \App\Services\MySecondService $service
     */
    public function setSecondService(MySecondService $service)
    {

    }

    public function doSomething()
    {

    }
    public function doSomething2()
    {
        return 'yey';
    }
}