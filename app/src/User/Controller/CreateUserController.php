<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use App\Trait\EntityManagerTrait;
use App\User\Api\UserFilterQueryInterface;
use App\User\Exception\UserNotFoundException;
use App\User\UserGroups;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\HttpStatusEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

/**
 * @see \App\Tests\User\Controller\CreateUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users', httpMethodEnum: HttpMethodEnum::POST)]
class CreateUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    #[ApiException(UserNotFoundException::class)]
    public function __invoke(#[MapRequestPayload] User $user, #[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQueryInterface $filterQuery): ApiResponse
    {
        $this->em->persist($user);
        $this->em->flush();

        return new ApiResponse(data: $user, groups: [UserGroups::READ, UserGroups::READ_ROLES], httpStatusEnum: HttpStatusEnum::CREATED);
    }
}
