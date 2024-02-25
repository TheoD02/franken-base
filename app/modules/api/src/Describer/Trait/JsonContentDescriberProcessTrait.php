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
        $jsonContent = current(
            array_filter($response->_unmerged, static fn ($item) => $item instanceof OAttributes\JsonContent)
        );

        if ($jsonContent === false) {
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

        if ($jsonContent->oneOf === Generator::UNDEFINED) {
            $jsonContent->oneOf = [];
        }

        if ($jsonContent->examples === Generator::UNDEFINED) {
            $jsonContent->examples = [];
        }

        if (\is_string($jsonContent)) {
            throw new \RuntimeException('What ? JsonContent is a string ?');
        }

        return $jsonContent;
    }
}
