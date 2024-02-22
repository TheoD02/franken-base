<?php

namespace App\Api\EventListener;

use App\Api\ApiResponse;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

#[AsEventListener(event: KernelEvents::VIEW)]
class KernelViewListener
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function onKernelView(ViewEvent $event): void
    {
        /**
         * @var ApiResponse $controllerResult
         */
        $controllerResult = $event->getControllerResult();

        $context = [
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ];

        $responseData = [
            'data' => $controllerResult->data,
            'meta' => $controllerResult->meta,
        ];
        $json = $this->serializer->serialize($responseData, 'json', $context);

        $jsonResponse = new JsonResponse();
        $jsonResponse->setJson($json);

        $jsonResponse->setStatusCode($controllerResult->status);

        $event->setResponse($jsonResponse);
    }
}