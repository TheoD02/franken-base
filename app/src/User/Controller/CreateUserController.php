<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use App\Trait\EntityManagerTrait;
use App\User\Api\UserFilterQuery;
use App\User\Exception\UserNotFound;
use App\User\Exception\UserProcessingException;
use App\User\UserGroups;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users', method: HttpMethodEnum::POST)]
class CreateUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    #[ApiException(UserNotFound::class)]
    public function __invoke(
        #[MapRequestPayload] User $user,
        #[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQuery $filterQuery,
    ): ApiResponse {
        $this->em->persist($user);
        $this->em->flush();

        return new ApiResponse(
            data: $user,
            groups: [UserGroups::READ, UserGroups::READ_ROLES],
            httpStatus: HttpStatus::CREATED
        );
    }
}
