<?php

namespace Module\Api\EventListener;

use Module\Api\ApiResponse;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

#[AsEventListener(event: KernelEvents::VIEW)]
readonly class KernelViewListener
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function onKernelView(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();

        if ($controllerResult instanceof ApiResponse === false) {
            // Do nothing for non-ApiResponse controller results (but maybe we should throw an exception here if we expect all controller results to be ApiResponse?)
            return;
        }


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