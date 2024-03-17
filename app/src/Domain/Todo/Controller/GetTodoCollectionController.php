<?php

declare(strict_types=1);

namespace App\Domain\Todo\Controller;

use App\Domain\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Domain\Todo\Serialization\TodoGroups;
use App\Domain\Todo\Service\TodoService;
use App\Domain\Todo\ValueObject\Todo;
use App\Domain\Todo\ValueObject\TodoCollection;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Module\Api\ValueObject\GenericCollectionMetadata;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;

#[AsController]
#[ApiRoute('/api/todos', httpMethodEnum: HttpMethodEnum::GET)]
class GetTodoCollectionController
{
    /**
     * @return ApiResponse<TodoCollection<array-key, Todo>, GenericCollectionMetadata>
     */
    #[OpenApiResponse(Todo::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[OpenApiMeta(GenericCollectionMetadata::class)]
    public function __invoke(TodoService $todoService, #[MapQueryString] ?TodoFilterQuery $todoFilterQuery = null): ApiResponse
    {
        $todos = $todoService->getTodos($todoFilterQuery);

        return new ApiResponse(data: $todos, apiMetadata: $todos->getMeta(), groups: [TodoGroups::READ]);
    }
}
