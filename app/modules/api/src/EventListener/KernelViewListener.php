<?php

declare(strict_types=1);

namespace Module\Api\EventListener;

use JetBrains\PhpStorm\NoReturn;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ApiDataInterface;
use Module\Api\Adapter\ApiMetadataInterface;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpStatusEnum;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @template T
 */
#[AsEventListener(event: KernelEvents::VIEW)]
readonly class KernelViewListener
{
    public function __construct(
        private SerializerInterface&NormalizerInterface $serializer,
    ) {
    }

    // TODO: Review the nullable type check, the case of empty with, without attribute and no return to handle case more fine-grained/proper way
    #[NoReturn]
    public function onKernelView(ViewEvent $viewEvent): void
    {
        /** @var ApiResponse<ApiDataInterface|ApiDataCollectionInterface<array-key, T>|bool|null, ApiMetadataInterface|null>|Response|null $controllerResult */
        $controllerResult = $viewEvent->getControllerResult();

        $reflectionMethod = $this->getControllerMethodReflectionClass($viewEvent);
        $openApiResponseAttribute = $reflectionMethod->getAttributes(OpenApiResponse::class)[0] ?? null;

        if ($controllerResult instanceof Response) {
            return;
        }

        if ($openApiResponseAttribute === null) {
            throw new \InvalidArgumentException('The controller must have an OpenApiResponse attribute when returning an instance of ApiResponse.');
        }

        /** @var OpenApiResponse $openApiResponseInstance */
        $openApiResponseInstance = $openApiResponseAttribute->newInstance();

        if ($controllerResult !== null && $controllerResult->httpStatusEnum === HttpStatusEnum::NO_CONTENT) {
            throw new \RuntimeException('The controller must return null or void when the status code is 204.');
        }

        if ($controllerResult === null && $openApiResponseInstance->empty === false) {
            throw new \InvalidArgumentException('The controller must return an instance of ApiResponse when it has an OpenApiResponse attribute.');
        }

        $jsonResponse = new JsonResponse();
        $statusCode = $controllerResult?->httpStatusEnum->value ?? null;

        if ($statusCode === null && ($controllerResult?->httpStatusEnum === HttpStatusEnum::NO_CONTENT || $openApiResponseInstance->empty === true)) {
            $statusCode = HttpStatusEnum::NO_CONTENT->value;
        }

        if ($statusCode === null) {
            throw new \InvalidArgumentException('The controller must return an instance of ApiResponse with a valid httpStatusEnum.');
        }

        $jsonResponse->setStatusCode($statusCode);

        if ($controllerResult?->httpStatusEnum === HttpStatusEnum::NO_CONTENT) {
            $viewEvent->setResponse($jsonResponse);

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

        $data = $controllerResult?->data;
        if ($data instanceof ApiDataCollectionInterface) {
            /** @phpstan-ignore-next-line */
            $data = $data->toArray();
        }

        $response = [
            'status' => $controllerResult?->httpStatusEnum->isSuccessful() ? 'success' : 'error',
            'data' => $this->serializer->normalize($data, context: $context),
            'meta' => $controllerResult?->apiMetadata ? $this->serializer->normalize($controllerResult->apiMetadata) : null,
        ];

        $jsonResponse->setData($response);

        $viewEvent->setResponse($jsonResponse);
    }

    protected function getControllerMethodReflectionClass(ViewEvent $viewEvent): \ReflectionMethod
    {
        $controller = $viewEvent->getRequest()->attributes->get('_controller');
        $controller = explode('::', (string) $controller);

        $controllerFqcn = \count($controller) !== 2 ? "{$controller[0]}::__invoke" : "{$controller[0]}::{$controller[1]}";

        return new \ReflectionMethod($controllerFqcn);
    }

    /**
     * @param ApiResponse<ApiDataInterface|ApiDataCollectionInterface<array-key, T>|bool|null, ApiMetadataInterface|null>|null $apiResponse
     *
     * @return array{json_encode_options: int, groups?: array<string>}
     */
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
