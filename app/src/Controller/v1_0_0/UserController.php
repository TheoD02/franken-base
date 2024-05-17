<?php

declare(strict_types=1);

namespace App\Controller\v1_0_0;

use Module\Api\Attribute\ApiSecurity;
use Module\Api\Attribute\ApiTag;
use Module\Api\Enum\ApiAreaEnum;
use Module\Api\Enum\ApiSecurityScopeEnum;
use Module\Api\Enum\ApiTagEnum;
use Nelmio\ApiDocBundle\Annotation\Areas;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Areas([ApiAreaEnum::PUBLIC])]
#[ApiTag(ApiTagEnum::USER)]
class UserController extends AbstractController
{
    #[OA\Get(
        description: 'Get all users from the database',
        summary: 'Get all users',
        externalDocs: new OA\ExternalDocumentation(description: 'Find out more about our user management', url: 'https://example.com/docs/user-management'),
        deprecated: false
    )]
    #[ApiSecurity([ApiSecurityScopeEnum::USER_READ])]
    #[Route('/users/{some-test}/is-not/possible/nah', name: 'v1_0_0_users', methods: [Request::METHOD_GET])]
    public function getUsers(): JsonResponse
    {
        return $this->json([
            'users' => [],
        ]);
    }
}
