<?php

declare(strict_types=1);

namespace Module\Api\Describer\Trait;

use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Attributes as OAttributes;
use OpenApi\Generator;

trait JsonContentDescriberProcessTrait
{
    protected function getJsonContent(OAnnotations\Response $response): OAttributes\JsonContent
    {
        $jsonContent = current(array_filter($response->_unmerged, static fn (mixed $item): bool => $item instanceof OAttributes\JsonContent));

        if ($jsonContent === false) {
            /** @phpstan-ignore-next-line */
            $jsonContent = new OAttributes\JsonContent();
            $context = Util::createContext([
                'nested' => $response,
            ], $response->_context);
            $jsonContent->_context = $context;
            $response->_unmerged[] = $jsonContent;
        }

        if ($jsonContent->description === Generator::UNDEFINED) {
            $jsonContent->description = 'Bad request.';
        }

        // @phpstan-ignore-next-line
        if ($jsonContent->oneOf === Generator::UNDEFINED) {
            $jsonContent->oneOf = [];
        }

        // @phpstan-ignore-next-line
        if ($jsonContent->examples === Generator::UNDEFINED) {
            $jsonContent->examples = [];
        }

        return $jsonContent;
    }
}
