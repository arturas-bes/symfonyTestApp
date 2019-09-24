<?php


namespace App\Services;

//use App\Services\MySecondService;
use Doctrine\ORM\Event\PostFlushEventArgs;
//Services global services and service params services.yaml and controller affected
class MyService implements ServiceInterface
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
       //dump('some message');

    }
    public function someAction()
    {
//        dump($this->doSomething2());
      //  dump('some message');
    }


//    /**
//     * @param \App\Services\MySecondService $second_service
//     * @required
//     */
//    public function setSecondService(MySecondService $second_service)
//    {
//        dump($second_service);

//    }

// postFlush event from service tags
    public function postFlush(PostFlushEventArgs $args)
    {
        dump('hello!');
        dump($args);
    }
// cache clear tag method
    public function clear()
    {
        dump('cache clear');
    }
}