<?php

namespace Module\Api\Attribute;

use Module\Api\Enum\ApiSecuritySchemeEnum;
use Module\Api\Enum\ApiSecurityScopeEnum;
use Nelmio\ApiDocBundle\Annotation\Security;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ApiSecurity extends Security
{
    /**
     * @param array<ApiSecurityScopeEnum> $securityScopes
     */
    public function __construct(
            array $securityScopes = [],
            ?ApiSecuritySchemeEnum $securityScheme = ApiSecuritySchemeEnum::BEARER,
    ) {
        parent::__construct(
                name: $securityScheme?->value,
                scopes: array_map(
                        fn(ApiSecurityScopeEnum $scope): string => $scope->value,
                        $securityScopes
                ),
        );
    }
}