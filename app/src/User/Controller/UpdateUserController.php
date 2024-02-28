<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Controller\Trait\EntityManagerTrait;
use App\Entity\User;
use App\Repository\UserRepository;
use AutoMapperPlus\AutoMapperInterface;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

use function dd;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::PATCH)]
class UpdateUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    public function __invoke(#[MapRequestPayload] User $user, int $id, AutoMapperInterface $mapper): ApiResponse
    {
        $userEntity = $this->em->find(User::class, $id);

        $userEntity = $mapper->mapToObject($user, $userEntity);
        $this->em->flush();

        return new ApiResponse($userEntity);
    }
}
