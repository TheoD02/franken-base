<?php

namespace App\Listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

use function dd;

#[AsEventListener(event: 'kernel.view')]
class ControllerViewListener
{
    public function __invoke(ViewEvent $event)
    {
        $controllerResult = $event->getControllerResult();

        $response = new JsonResponse($controllerResult);

        $event->setResponse($response);
    }
}