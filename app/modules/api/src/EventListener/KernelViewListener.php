<?php

declare(strict_types=1);

namespace Module\Api\EventListener;

use JetBrains\PhpStorm\NoReturn;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpStatusEnum;
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

    // TODO: Review the nullable type check, the case of empty with, without attribute and no return to handle case more fine-grained/proper way
    #[NoReturn]
    public function onKernelView(ViewEvent $event): void
    {
        /** @var ?ApiResponse $controllerResult */
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

        if ($controllerResult?->httpStatus === HttpStatusEnum::NO_CONTENT && $controllerResult !== null) {
            throw new \RuntimeException('The controller must return null or void when the status code is 204.');
        }

        if ($controllerResult instanceof ApiResponse === false && $controllerResult?->httpStatus !== HttpStatusEnum::NO_CONTENT && $openApiResponseInstance->empty !== true) {
            throw new \InvalidArgumentException(
                'The controller must return an instance of ApiResponse when it has an OpenApiResponse attribute.'
            );
        }

        $jsonResponse = new JsonResponse();
        $defaultStatusCode = $openApiResponseInstance->empty ? HttpStatusEnum::NO_CONTENT : HttpStatusEnum::OK;
        $jsonResponse->setStatusCode(($controllerResult?->httpStatus ?? $defaultStatusCode)->value);

        if ($controllerResult?->httpStatus === HttpStatusEnum::NO_CONTENT) {
            $event->setResponse($jsonResponse);

            return;
        }

        if (
            $controllerResult?->data instanceof ApiDataCollectionInterface
            && $openApiResponseInstance->isCollection() === false
        ) {
            throw new \InvalidArgumentException(
                'The controller must return a collection in `data` property when the #[OpenApiResponse] attribute indicates a collection response type.'
            );
        }

        $context = $this->prepareSerializerContext($controllerResult);

        $data = $openApiResponseInstance->isCollection() ?
            $controllerResult?->data->all(false) :
            $controllerResult?->data;
        $response = [
            'status' => $controllerResult?->httpStatus->isSuccessful() ? 'success' : 'error',
            'data' => $this->serializer->normalize($data, context: $context),
            'meta' => $controllerResult?->meta ? $this->serializer->normalize($controllerResult->meta) : null,
        ];

        $jsonResponse->setData($response);

        $event->setResponse($jsonResponse);
    }

    protected function getControllerMethodReflectionClass(ViewEvent $event): \ReflectionMethod
    {
        $controller = $event->getRequest()->attributes->get('_controller');
        $controller = explode('::', (string)$controller);
        if (\count($controller) !== 2) {
            $controller = "{$controller[0]}::__invoke";
        } else {
            $controller = "{$controller[0]}::{$controller[1]}";
        }

        return new \ReflectionMethod($controller);
    }

    protected function prepareSerializerContext(?ApiResponse $apiResponse): array
    {
        $groups = $apiResponse?->groups ?? [];

        $context = [
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ];

        if ($groups !== []) {
            $context['groups'] = $groups;
        }

        return $context;
    }
}
