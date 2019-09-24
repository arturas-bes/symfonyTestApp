<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
//     custom event we created
    public function onVideoCreatedEvent($event)
    {
      //  dump($event->video->title);
    }
//    default event to change response
    public function onKernelResponse1(FilterResponseEvent $event)
    {
//        $response = new Response('dupa');
//        $event->setResponse($response);
     //   dump('response 1 ');
    }


    public function onKernelResponse2(FilterResponseEvent $event)
    {
//        $response = new Response('dupa');
//        $event->setResponse($response);
    //    dump('response 2 ');

    }


// default method to gett all event for a subscriber
// last argument defines priority for event to fire higher the numbe rhighher the priority
    public static function getSubscribedEvents()
    {
        return [
           'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => [
            ['onKernelResponse1', 1],
            ['onKernelResponse2', 2],
            ],
        ];
    }
}
