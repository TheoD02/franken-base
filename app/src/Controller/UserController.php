<?php

namespace App\Controller;

use App\Dto\PaginationFilterQuery;
use App\Dto\User;
use App\Dto\UserFilterQuery;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Tag;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[AsController]
#[Tag('user')]
class UserController
{
    #[Route('/api/users', name: 'api', methods: ['GET'])]
    #[OA\Response(ref: new Model(type: User::class), response: 200, description: 'Returns the user')]
    public function index(
        #[MapQueryString] ?UserFilterQuery $query,
        #[MapQueryString] ?PaginationFilterQuery $pagination
    ): User {
        return (new User())
            ->setEmail('test@gmail.com')
            ->setName('test');
    }
}