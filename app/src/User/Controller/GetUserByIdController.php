<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\User;
use Module\Api\ApiResponse;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::GET)]
class GetUserByIdController
{
    public function __invoke(int $id, User $user): ApiResponse
    {
        return new ApiResponse((new User())->setName('John Doe')->setEmail('john@doe.fr'));
    }
}
