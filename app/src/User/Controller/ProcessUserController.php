<?php

namespace App\User\Controller;

use App\Api\ApiResponse;
use App\Api\Attribut\ApiRoute;
use App\Api\Attribut\BadRequestResponse;
use App\Api\Attribut\OpenApiMeta;
use App\Api\Attribut\OpenApiResponse;
use App\Api\Enum\HttpMethod;
use App\Api\Enum\ResponseType;
use App\User\Api\UserMeta;
use App\User\Exception\UserProcessingException;
use App\User\User;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}/process', method: HttpMethod::GET)]
class ProcessUserController
{
    #[OpenApiResponse(User::class, type: ResponseType::COLLECTION)]
    #[OpenApiMeta(UserMeta::class)]
    #[BadRequestResponse]
    public function __invoke(): ApiResponse
    {
        // Do some stuff/processing

        // OH NO! Something went wrong
        throw new UserProcessingException();

        return new ApiResponse(
            (new User())->setName('John Doe')->setEmail('john@doe.fr'),
        );
    }
}
