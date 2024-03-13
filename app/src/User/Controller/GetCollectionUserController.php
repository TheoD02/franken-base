<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Trait\EntityManagerTrait;
use App\User\Api\UserCollectionMeta;
use App\User\Api\UserFilterQuery;
use App\User\UserCollection;
use App\User\UserGroups;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;

/**
 * @see \App\Tests\User\Controller\GetCollectionUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users', httpMethodEnum: HttpMethodEnum::GET)]
class GetCollectionUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<UserCollection, UserCollectionMeta>
     */
    #[OpenApiResponse(User::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[OpenApiMeta(UserCollectionMeta::class)]
    public function __invoke(#[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQuery $filterQuery): ApiResponse
    {
        /** @var UserRepository $entityRepository */
        $entityRepository = $this->em->getRepository(User::class);
        $userCollection = $entityRepository->findByFilterQuery($filterQuery);

        return new ApiResponse(data: $userCollection, apiMetadata: $userCollection->getMeta(), groups: [UserGroups::READ]);
    }
}
