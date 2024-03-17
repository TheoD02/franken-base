<?php

declare(strict_types=1);

namespace App\Todo\Controller;

use App\Todo\Serialization\TodoGroups;
use App\Todo\Service\TodoService;
use App\Todo\ValueObject\Todo;
use App\Todo\ValueObject\TodoCollection;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Module\Api\ValueObject\GenericCollectionMetadata;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/todos', httpMethodEnum: HttpMethodEnum::GET)]
class GetTodoCollectionController
{
    /**
     * @return ApiResponse<TodoCollection<array-key, Todo>, GenericCollectionMetadata>
     */
    #[OpenApiResponse(Todo::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[OpenApiMeta(GenericCollectionMetadata::class)]
    public function __invoke(TodoService $todoService): ApiResponse
    {
        $todoCollection = $todoService->getTodos();

        return new ApiResponse(data: $todoCollection, apiMetadata: $todoCollection->getMeta(), groups: [TodoGroups::READ]);
    }
}
