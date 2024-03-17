<?php

declare(strict_types=1);

namespace App\Domain\Todo\Controller;

use App\Domain\Todo\Serialization\TodoGroups;
use App\Domain\Todo\Service\TodoService;
use App\Domain\Todo\ValueObject\Todo;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Module\Api\ValueObject\GenericCollectionMetadata;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/todos/{id}', httpMethodEnum: HttpMethodEnum::GET)]
class GetOneTodoByIdController
{
    /**
     * @return ApiResponse<Todo, null>
     */
    #[OpenApiResponse(Todo::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[OpenApiMeta(GenericCollectionMetadata::class)]
    public function __invoke(TodoService $todoService, int $id): ApiResponse
    {
        $todo = $todoService->getOneById($id);

        return new ApiResponse(data: $todo, groups: [TodoGroups::READ]);
    }
}
