<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\ApiPlatform\OpenApi;

use ApiPlatform\Api\FilterInterface;
use Symfony\Component\PropertyInfo\Type;

final readonly class AuthorFilter implements FilterInterface
{
    /**
     * @param class-string $resourceClass
     */
    public function getDescription(string $resourceClass): array // @phpstan-ignore-line
    {
        return [
            'author' => [
                'property' => 'author',
                'type' => Type::BUILTIN_TYPE_STRING,
                'required' => false,
            ],
        ];
    }
}
