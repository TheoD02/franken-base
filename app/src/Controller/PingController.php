<?php

declare(strict_types=1);

namespace App\Controller;

use Module\Api\Attribute\ApiSecurity;
use Module\Api\Attribute\ApiTag;
use Module\Api\Enum\ApiAreaEnum;
use Module\Api\Enum\ApiTagEnum;
use Nelmio\ApiDocBundle\Annotation\Areas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Areas([ApiAreaEnum::PUBLIC])]
#[ApiTag(ApiTagEnum::HEALTH)]
class PingController extends AbstractController
{
    #[Route('/ping', name: 'ping', methods: [Request::METHOD_GET])]
    #[ApiSecurity(securityScheme: null)]
    public function ping(): JsonResponse
    {
        return $this->json([
            'ping' => 'pong',
        ]);
    }
}
