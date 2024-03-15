<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Trait\EntityManagerTrait;
use App\User\Entity\UserEntity;
use App\User\Exception\UserNotFoundException;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;

/**
 * @see \App\Tests\User\Controller\DeleteUserByIdControllerTest
 */
#[AsController]
#[ApiRoute('/api/users/{id}', httpMethodEnum: HttpMethodEnum::DELETE)]
class DeleteUserByIdController
{
    use EntityManagerTrait;

    #[OpenApiResponse(empty: true)]
    #[ApiException(UserNotFoundException::class)]
    public function __invoke(int $id): void
    {
        $user = $this->em->find(UserEntity::class, $id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        $this->em->remove($user);
        $this->em->flush();
    }
}
