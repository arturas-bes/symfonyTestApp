<?php


namespace App\Services;

//use App\Services\MySecondService;

//Services global services and service params services.yaml and controller affected
class MyService
{

    public $logger;

    public $my;
//    use OptionalServiceTrait;

    public function __construct()
    {
//        dump($param);
//        dump($param2);
//        dump($adminEmail);
//        dump($globalParam);
//        dump($second_service);
    dump('ha we work now');

    }
    public function someAction()
    {
//        dump($this->doSomething2());
        dump($this->logger);
        dump($this->my);
    }


//    /**
//     * @param \App\Services\MySecondService $second_service
//     * @required
//     */
//    public function setSecondService(MySecondService $second_service)
//    {
//        dump($second_service);

//    }

    public function postFlush()
    {
        dump('post flush');

    }
}