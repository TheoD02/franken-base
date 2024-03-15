<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Repository\UserRepository;
use App\Trait\EntityManagerTrait;
use App\User\Api\UserCollectionMeta;
use App\User\Api\UserFilterQueryInterface;
use App\User\Entity\UserEntity;
use App\User\Serialization\UserGroups;
use App\User\ValueObject\UserCollection;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Module\Api\Service\PaginatorService;
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
    #[OpenApiResponse(UserEntity::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[OpenApiMeta(UserCollectionMeta::class)]
    public function __invoke(PaginatorService $paginator, #[MapQueryString(
        validationFailedStatusCode: 400
    )] ?UserFilterQueryInterface $filterQuery): ApiResponse
    {
        /** @var UserRepository $entityRepository */
        $entityRepository = $this->em->getRepository(UserEntity::class);
        $queryBuilder = $entityRepository->createQueryBuilder('entity');

        $userCollection = $paginator->paginate($queryBuilder, UserCollection::class, [$filterQuery]);

        return new ApiResponse(data: $userCollection, apiMetadata: $userCollection->getMeta(), groups: [UserGroups::READ]);
    }
}
