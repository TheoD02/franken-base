<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\Api\UserMeta;
use App\User\Exception\UserProcessingException;
use App\User\User;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Module\Api\Enum\ResponseType;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}/process', method: HttpMethod::GET)]
class ProcessUserController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class, type: ResponseType::COLLECTION)]
    #[OpenApiMeta(UserMeta::class)]
    #[ApiException(UserProcessingException::class)]
    public function __invoke(): ApiResponse
    {
        // Do some stuff/processing

        // OH NO! Something went wrong
        throw new UserProcessingException();

        // @phpstan-ignore-next-line - this is just for the example
        return new ApiResponse((new User())->setName('John Doe')->setEmail('john@doe.fr'));
    }
}
