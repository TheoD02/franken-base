<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Controller\UserController;
use function dd;

#[AsEventListener(event: KernelEvents::VIEW)]
class KernelViewListener
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function onKernelView(ViewEvent $event): void
    {
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