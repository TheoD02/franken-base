<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use App\User\Exception\UserNotFoundException;
use App\User\Exception\AbstractUserProcessingException;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;

/**
 * @see \App\Tests\User\Controller\ProcessUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users/{id}/process', httpMethodEnum: HttpMethodEnum::GET)]
class ProcessUserController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
    #[ApiException(AbstractUserProcessingException::class)]
    #[ApiException(UserNotFoundException::class)]
    public function __invoke(int $id): ApiResponse
    {
        // Do some stuff/processing

        // OH NO! Something went wrong
        throw new AbstractUserProcessingException([
            'userId' => $id,
        ], 'It seem that something went wrong while processing the user. Maybe the user provider is down? Is the user still in the database?', );
    }
}
