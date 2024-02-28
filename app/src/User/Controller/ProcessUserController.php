<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use App\User\Exception\UserNotFound;
use App\User\Exception\UserProcessingException;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}/process', method: HttpMethodEnum::GET)]
class ProcessUserController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class, type: ResponseTypeEnum::COLLECTION)]
    #[ApiException(UserProcessingException::class)]
    #[ApiException(UserNotFound::class)]
    public function __invoke(int $id): ApiResponse
    {
        // Do some stuff/processing

        // OH NO! Something went wrong
        throw new UserProcessingException([
            'userId' => $id,
        ], 'It seem that something went wrong while processing the user. Maybe the user provider is down? Is the user still in the database?', );

        // @phpstan-ignore-next-line - this is just for the example
        return new ApiResponse((new User())->setName('John Doe')->setEmail('john@doe.fr'));
    }
}
