<?php


namespace App\EventListeners;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class KernelResponseListener
{

//    In this event we can modify response event before its send to the browser
// if its not taged in configuration file these events have to start with "on"
    public function onKernelResponse(FilterResponseEvent $event)
    {
//        $response = new Response('dupa');
//        $event->setResponse($response);
    }
}