<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Controller\Trait\EntityManagerTrait;
use App\Entity\User;
use App\User\Api\UserFilterQuery;
use App\User\Exception\UserNotFound;
use App\User\Exception\UserProcessingException;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users', method: HttpMethod::POST)]
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

        return new ApiResponse($user);
    }
}
