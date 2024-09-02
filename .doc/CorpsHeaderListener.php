<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CorpsHeaderListener
{
    public function addHeader(ResponseEvent $event)
    {
        $response = $event->getResponse();

        $response->headers->add([
            'Access-Control-Allow-Origin' => '*'
        ]);
        $response->headers->set(
            'Access-Control-Allow-Origin',
            '*'
        );
    }
}