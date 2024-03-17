<?php

declare(strict_types=1);

namespace App\User\Controller\GetUserCollectionController;

use App\Trait\EntityManagerTrait;
use App\User\Serialization\UserGroups;
use App\User\Service\UserService;
use App\User\ValueObject\User;
use App\User\ValueObject\UserCollection;
use App\User\ValueObject\UserCollectionMeta;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Dto\PaginationFilterQuery;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;

/**
 * @see \App\Tests\User\Controller\GetCollectionUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users', httpMethodEnum: HttpMethodEnum::GET)]
class GetUserCollectionController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<UserCollection<array-key, User>, UserCollectionMeta>
     */
    #[OpenApiResponse(User::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[OpenApiMeta(UserCollectionMeta::class)]
    public function __invoke(
        UserService $userService,
        #[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQuery $filterQuery = null,
        #[MapQueryString(validationFailedStatusCode: 400)] ?PaginationFilterQuery $paginationFilterQuery = null,
    ): ApiResponse {
        $userCollection = $userService->paginate($filterQuery, $paginationFilterQuery);

        return new ApiResponse(data: $userCollection, apiMetadata: $userCollection->getMeta(), groups: [UserGroups::READ]);
    }
}