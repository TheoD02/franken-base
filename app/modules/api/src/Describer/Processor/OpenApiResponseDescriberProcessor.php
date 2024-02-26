<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\HttpStatus;
use Module\Api\Enum\ResponseType;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\Schema;
use OpenApi\Attributes as OAttributes;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\ParserFactory;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;

class OpenApiResponseDescriberProcessor implements DescriberProcessorInterface, ModelRegistryAwareInterface
{
    use JsonContentDescriberProcessTrait;
    use ModelRegistryAwareTrait;

    private static array $responseSchemaList = [];
    private static OAttributes\Schema $schema;

    #[\Override]
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool {
        $openApiResponseAttributes = $reflectionMethod->getAttributes(OpenApiResponse::class);

        return \count($openApiResponseAttributes) > 0;
    }

    #[\Override]
    public function process(
        OAnnotations\OpenApi $api,
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): OAnnotations\OpenApi {
        $parser = (new ParserFactory())->createForNewestSupportedVersion();
        $groups = [];
        try {
            $ast = $parser->parse(file_get_contents($reflectionMethod->getFileName()));

            if ($ast === null) {
                throw new \RuntimeException('The file could not be parsed.');
            }

            $class = null;
            foreach ($ast as $node) {
                if ($node instanceof Namespace_) {
                    $class = end($node->stmts);
                }
            }

            $method = $this->getMethod($class, $reflectionMethod);
            $returnStmt = $this->getReturnStmt($method);

            if ($returnStmt === null) {
                $httpStatus = HttpStatus::NO_CONTENT;
            } else {
                $name = $returnStmt->expr->class->toString();
                if ($name !== 'ApiResponse') {
                    throw new \RuntimeException('The return type of the method must be ApiResponse.');
                }

                $httpStatus ??= $this->getHttpStatus($returnStmt, $ast);
                $groups = $this->getGroups($returnStmt, $ast);
            }
        } catch (\PhpParser\Error $e) {
            throw new \RuntimeException('An error occurred while parsing the file.', 0, $e);
        }

        [$openApiResponseInstance, $openApiMetaInstance] = $this->getAttributesInstance($reflectionMethod);

        $statusCode = $httpStatus->value;
        $responseType = $openApiResponseInstance->type;
        $responseClass = $openApiResponseInstance->class;

        /** @var OAnnotations\Response $response */
        $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);

        if ($response->description === Generator::UNDEFINED) {
            $response->description = $httpStatus->getShortName() . ' response.';
        }
        $response->content = [];
        $response->content['application/json'] = new MediaType([
            'mediaType' => 'application/json',
        ]);

        if ($httpStatus === HttpStatus::NO_CONTENT) {
            $response->description = $httpStatus->getShortName();

            return $api;
        }

        /** @var Schema $schema */
        $schema = Util::getChild($response->content['application/json'], Schema::class);
        $schema->type = 'object';

        $schema->properties = [
            $this->getDataProperty($responseClass, $groups, $responseType),
            $this->getMetaProperty($openApiMetaInstance),
        ];

        return $api;
    }

    private function getOpenApiModel(string $classFqcn, array $groups = []): string
    {
        $model = new Model(
            type: new Type(Type::BUILTIN_TYPE_OBJECT, false, $classFqcn),
            serializationContext: $groups !== [] ? [
                'groups' => $groups,
            ] : [],
        );

        return $this->modelRegistry->register($model);
    }

    private function getDataProperty(string $responseClass, array $groups, ResponseType $responseType): Property
    {
        $dataProperty = new Property(property: 'data', description: 'The data of the response.');
        $ref = $this->getOpenApiModel($responseClass, $groups);
        if ($responseType === ResponseType::COLLECTION) {
            $dataProperty->type = 'array';
            $dataProperty->items = new Items(
                ref: $ref,
                description: 'The item of the collection.',
                type: 'object',
            );
        } else {
            $dataProperty->type = 'object';
            $dataProperty->ref = $ref;
        }

        return $dataProperty;
    }

    private function getMetaProperty(?OpenApiMeta $openApiMetaInstance): ?Property
    {
        $metaProperty = new Property(property: 'meta', description: 'The meta of the response.', type: 'object');

        if ($openApiMetaInstance === null) {
            $metaProperty->example = null;

            return $metaProperty;
        }

        if ($openApiMetaInstance->class === null) {
            throw new \RuntimeException('The OpenApiMeta attribute must have a class property.');
        }

        if (class_exists($openApiMetaInstance->class) === false) {
            throw new \RuntimeException('The class of the OpenApiMeta attribute does not exist.');
        }

        $metaProperty->type = 'object';
        $metaProperty->ref = $this->getOpenApiModel($openApiMetaInstance->class);

        return $metaProperty;
    }

    /**
     * @return array{OpenApiResponse, OpenApiMeta|null}
     */
    protected function getAttributesInstance(\ReflectionMethod $reflectionMethod): array
    {
        $openApiResponseAttributes = $reflectionMethod->getAttributes(OpenApiResponse::class);
        $openApiMetaAttributes = $reflectionMethod->getAttributes(OpenApiMeta::class);

        if (\count($openApiResponseAttributes) > 1) {
            throw new \RuntimeException('An endpoint can only have one OpenApiResponse attribute.');
        }

        if (\count($openApiMetaAttributes) > 1) {
            throw new \RuntimeException('An endpoint can only have one OpenApiMeta attribute.');
        }

        /** @var OpenApiResponse $openApiResponseInstance */
        $openApiResponseInstance = $openApiResponseAttributes[0]->newInstance();

        /** @var ?OpenApiMeta $openApiMetaInstance */
        $openApiMetaInstance = null;
        if (\count($openApiMetaAttributes) > 0) {
            $openApiMetaInstance = $openApiMetaAttributes[0]->newInstance();
        }

        return [$openApiResponseInstance, $openApiMetaInstance];
    }

    protected function getMethod(mixed $class, \ReflectionMethod $reflectionMethod): ClassMethod
    {
        $method = null;
        foreach ($class->stmts as $stmt) {
            if ($stmt->name->name === $reflectionMethod->getName()) {
                $method = $stmt;
                break;
            }
        }

        return $method;
    }

    protected function getReturnStmt(ClassMethod $method): ?\PhpParser\Node\Stmt\Return_
    {
        $returnStmt = null;
        foreach ($method->stmts as $stmt) {
            if ($stmt instanceof \PhpParser\Node\Stmt\Return_) {
                if ($returnStmt !== null) {
                    throw new \RuntimeException('The method must have a return statement.');
                }
                $returnStmt = $stmt;
            }
        }

        return $returnStmt;
    }

    /**
     * @return array<class-string, \BackedEnum>
     */
    protected function getGroups(\PhpParser\Node\Stmt\Return_ $returnStmt, ?array $ast): array
    {
        $groupsArgs = null;
        foreach ($returnStmt->expr->args as $arg) {
            if ($arg->name?->name === 'groups') {
                $groupsArgs = $arg;
            }
        }

        $groups = [];
        if ($groupsArgs !== null) {
            /** @var array<string, string> $groups {className, nameOfTheGroup} */
            $groups = array_map(
                static fn (ArrayItem $group) => [$group->value?->class->name, $group->value?->name->name],
                $groupsArgs->value->items
            );
        }

        $groupedByClass = [];
        foreach ($groups as $group) {
            $groupedByClass[$group[0]][] = $group[1];
        }

        $groups = [];
        // get the class fqcn from name of class
        foreach (array_keys($groupedByClass) as $className) {
            foreach ($ast as $node) {
                if ($node instanceof Namespace_) {
                    foreach ($node->stmts as $stmt) {
                        if ($stmt instanceof Use_) {
                            foreach ($stmt->uses as $use) {
                                if ($use->alias === $className || $use->name->getLast() === $className) {
                                    $classFqcn = $use->name->toString();
                                    $reflectionClass = new \ReflectionClass($classFqcn);
                                    if ($reflectionClass->isEnum()) {
                                        $cases = $reflectionClass->getConstants();
                                        foreach ($groupedByClass[$className] as $group) {
                                            $groups[] = $cases[$group];
                                        }
                                        unset($groupedByClass[$className]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $groups;
    }

    private function getHttpStatus(\PhpParser\Node\Stmt\Return_ $returnStmt, array $ast): HttpStatus
    {
        $httpStatus = null;
        foreach ($returnStmt->expr->args as $arg) {
            if ($arg->name?->name === 'httpStatus') {
                $httpStatus = $arg;
            }
        }

        if ($httpStatus === null) {
            return HttpStatus::OK;
        }

        $value = $httpStatus->value->name->name;
        $httpStatusClassName = $httpStatus->value->class->name;
        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Use_) {
                        foreach ($stmt->uses as $use) {
                            if ($use->alias === $httpStatusClassName || $use->name->getLast(
                            ) === $httpStatusClassName) {
                                $reflectionClass = new \ReflectionClass($use->name->toString());
                                if ($reflectionClass->isEnum()) {
                                    $cases = $reflectionClass->getConstants();
                                    $httpStatus = $cases[$value];
                                }
                            }
                        }
                    }
                }
            }
        }

        return $httpStatus;
    }
}
