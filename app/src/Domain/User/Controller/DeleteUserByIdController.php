<?php

declare(strict_types=1);

namespace App\Domain\User\Controller;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Service\UserService;
use App\Trait\EntityManagerTrait;
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
    public function __invoke(int $id, UserService $userService): void
    {
        $userService->delete($id);
    }
}
