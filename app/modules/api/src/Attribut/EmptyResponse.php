<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use OpenApi\Attributes\Response;

#[\Attribute(\Attribute::TARGET_METHOD)]
class EmptyResponse extends Response
{
    public function __construct()
    {
        parent::__construct(
            response: 204,
            description: 'No content.',
        );
    }
}
