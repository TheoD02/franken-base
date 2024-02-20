<?php

namespace App\Controller;

use App\Api\ApiResponse;
use App\Api\SuccessResponse;
use App\User\User;
use App\User\UserCollection;
use App\User\UserFilterQuery;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class UserController
{
    /**
     * @param UserFilterQuery|null $filterQuery
     * @return ApiResponse<{UserCollection<User>}>
     */
    #[Route('/api/users', name: 'api_users', methods: ['GET'])]
    #[SuccessResponse(class: User::class)]
    /*#[Response(response: 200, description: 'coucou', content: new JsonContent(ref: new Model(type: UserCollection::class)))]*/
    public function index(#[MapQueryString] ?UserFilterQuery $filterQuery): ApiResponse
    {
        return new ApiResponse(
            UserCollection::fromIterable([
                (new User())->setName('John Doe')->setEmail('john@doe.fr'),
                (new User())->setName('Jane Doe')->setEmail('jane@doe.fr'),
            ]),
        );
    }

    #[Route('/api/users/{id}', name: 'api_users_get', methods: ['GET'])]
    public function show(int $id): ApiResponse
    {
        return new ApiResponse(
            (new User())->setName('John Doe')->setEmail('john@doe.fr'),
        );
    }

    #[Route('/api/users', name: 'api_create_user', methods: ['POST'])]
    public function create(#[MapRequestPayload] User $user): ApiResponse
    {
        return new ApiResponse($user);
    }

    #[Route('/api/users/{id}', name: 'api_update_user', methods: ['PUT'])]
    public function update(int $id, #[MapRequestPayload] User $user): ApiResponse
    {
        return new ApiResponse($user);
    }

    #[Route('/api/users/{id}', name: 'api_delete_user', methods: ['DELETE'])]
    public function delete(int $id): ApiResponse
    {
        return new ApiResponse(null, status: 204);
    }
}
