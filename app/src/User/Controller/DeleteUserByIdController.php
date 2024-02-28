<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Controller\Trait\EntityManagerTrait;
use App\Entity\User;
use App\User\Exception\UserNotFound;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::DELETE)]
class DeleteUserByIdController
{
    use EntityManagerTrait;

    #[OpenApiResponse(empty: true)]
    public function __invoke(int $id): void
    {
        $user = $this->em->find(User::class, $id);

        if ($user === null) {
            throw new UserNotFound();
        }

        $this->em->remove($user);
        $this->em->flush();
    }
}
