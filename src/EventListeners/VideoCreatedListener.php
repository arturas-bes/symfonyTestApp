<?php


namespace App\EventListeners;


class VideoCreatedListener
{
    public function onVideoCreatedEvent($event)
    {
        dump($event->video->title);
    }
}