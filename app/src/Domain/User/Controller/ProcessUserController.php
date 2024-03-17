<?php

declare(strict_types=1);

namespace App\Domain\User\Controller;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Exception\AbstractUserProcessingException;
use App\Domain\User\Exception\UserNotFoundException;
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
     * @return ApiResponse<UserEntity, null>
     */
    #[OpenApiResponse(UserEntity::class, responseTypeEnum: ResponseTypeEnum::COLLECTION)]
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
