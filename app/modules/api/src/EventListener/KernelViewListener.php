<?php

declare(strict_types=1);

namespace Module\Api\EventListener;

use JetBrains\PhpStorm\NoReturn;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpStatus;
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

    #[NoReturn]
    public function onKernelView(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();

        $reflection = $this->getControllerMethodReflectionClass($event);
        $openApiResponseAttribute = $reflection->getAttributes(OpenApiResponse::class)[0] ?? null;

        if ($controllerResult instanceof ApiResponse && $openApiResponseAttribute === null) {
            throw new \InvalidArgumentException(
                'The controller must have an OpenApiResponse attribute when returning an instance of ApiResponse.'
            );
        }

        /** @var OpenApiResponse $openApiResponseInstance */
        $openApiResponseInstance = $openApiResponseAttribute->newInstance();

        if ($openApiResponseInstance->statusCode === HttpStatus::NO_CONTENT && $controllerResult !== null) {
            throw new \RuntimeException('The controller must return null or void when the status code is 204.');
        }

        if ($controllerResult instanceof ApiResponse === false && $openApiResponseInstance->statusCode !== HttpStatus::NO_CONTENT) {
            throw new \InvalidArgumentException(
                'The controller must return an instance of ApiResponse when it has an OpenApiResponse attribute.'
            );
        }

        $jsonResponse = new JsonResponse();
        $jsonResponse->setStatusCode($openApiResponseInstance->statusCode->value);

        if ($openApiResponseInstance->statusCode === HttpStatus::NO_CONTENT) {
            $event->setResponse($jsonResponse);

            return;
        }

        $responseData = [
            'data' => $controllerResult->data,
            'meta' => $controllerResult->meta,
        ];

        $context = $this->prepareSerializerContext($openApiResponseInstance);

        $json = $this->serializer->serialize($responseData, 'json', $context);

        $jsonResponse->setJson($json);

        $event->setResponse($jsonResponse);
    }

    protected function getControllerMethodReflectionClass(ViewEvent $event): \ReflectionMethod
    {
        $controller = $event->getRequest()->attributes->get('_controller');
        $controller = explode('::', (string) $controller);
        if (\count($controller) !== 2) {
            $controller = "{$controller[0]}::__invoke";
        } else {
            $controller = "{$controller[0]}::{$controller[1]}";
        }

        return new \ReflectionMethod($controller);
    }

    protected function prepareSerializerContext(OpenApiResponse $openApiResponseInstance): array
    {
        $groups = $openApiResponseInstance->groups;

        $context = [
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ];

        if ($groups !== []) {
            $context['groups'] = $groups;
        }

        return $context;
    }
}
