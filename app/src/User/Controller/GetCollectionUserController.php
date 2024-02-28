<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Controller\Trait\EntityManagerTrait;
use App\Entity\User;
use App\User\Api\UserCollectionMeta;
use App\User\Api\UserFilterQuery;
use App\User\UserCollection;
use App\User\UserGroups;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Module\Api\Enum\ResponseType;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;

#[AsController]
#[ApiRoute('/api/users', method: HttpMethod::GET)]
class GetCollectionUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<UserCollection, UserCollectionMeta>
     */
    #[OpenApiResponse(User::class, groups: [UserGroups::READ], type: ResponseType::COLLECTION)]
    #[OpenApiMeta(UserCollectionMeta::class)]
    public function __invoke(
        #[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQuery $filterQuery
    ): ApiResponse {
        $collection = $this->em->getRepository(User::class)->findByFilterQuery($filterQuery);

        return new ApiResponse(data: $collection, meta: $collection->getMeta());
    }
}
