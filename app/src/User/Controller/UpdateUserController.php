<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Trait\EntityManagerTrait;
use App\User\Entity\UserEntity;
use App\User\Exception\UserNotFoundException;
use App\User\Serialization\UserGroups;
use AutoMapperPlus\AutoMapperInterface;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

/**
 * @see \App\Tests\User\Controller\UpdateUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users/{id}', httpMethodEnum: HttpMethodEnum::PATCH)]
class UpdateUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<UserEntity, null>
     */
    #[OpenApiResponse(UserEntity::class)]
    #[ApiException(UserNotFoundException::class)]
    public function __invoke(#[MapRequestPayload] UserEntity $user, int $id, AutoMapperInterface $mapper): ApiResponse
    {
        $userEntity = $this->em->find(UserEntity::class, $id);

        if ($userEntity === null) {
            throw new UserNotFoundException();
        }

        /** @var UserEntity $userEntity */
        $userEntity = $mapper->mapToObject($user, $userEntity);
        $this->em->flush();

        return new ApiResponse(data: $userEntity, groups: [UserGroups::READ, UserGroups::READ_ROLES]);
    }
}
