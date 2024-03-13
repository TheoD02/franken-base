<?php

declare(strict_types=1);

namespace Module\Api\Resolver;

use Module\Api\Enum\HttpStatusEnum;
use PhpParser\Error;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\ParserFactory;

class ApiResponseAstResolver
{
    public function resolve(\ReflectionMethod $reflectionMethod): array
    {
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

            if (! $returnStmt instanceof Return_) {
                $httpStatus = HttpStatusEnum::NO_CONTENT;
            } else {
                $name = $returnStmt->expr->class->toString();
                if ($name !== 'ApiResponse') {
                    throw new \RuntimeException('The return type of the method must be ApiResponse.');
                }

                $httpStatus ??= $this->getHttpStatus($returnStmt, $ast);
                $groups = $this->getGroups($returnStmt, $ast);
            }
        } catch (Error $error) {
            throw new \RuntimeException('An error occurred while parsing the file.', 0, $error);
        }

        return [$httpStatus, $groups];
    }

    protected function getMethod(mixed $class, \ReflectionMethod $reflectionMethod): ClassMethod
    {
        $method = null;
        foreach ($class->stmts as $stmt) {
            if ($stmt instanceof ClassMethod === false) {
                continue;
            }

            if ($stmt->name->name === $reflectionMethod->getName()) {
                $method = $stmt;
                break;
            }
        }

        return $method;
    }

    protected function getReturnStmt(ClassMethod $classMethod): ?Return_
    {
        $returnStmt = null;
        foreach ($classMethod->stmts as $stmt) {
            if ($stmt instanceof Return_) {
                if ($returnStmt instanceof Return_) {
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
    protected function getGroups(Return_ $return, ?array $ast): array
    {
        $groupsArgs = null;
        foreach ($return->expr->args as $arg) {
            if ($arg->name?->name === 'groups') {
                $groupsArgs = $arg;
            }
        }

        $groups = [];
        if ($groupsArgs !== null) {
            /** @var array<string, string> $groups {className, nameOfTheGroup} */
            $groups = array_map(
                static fn (ArrayItem $arrayItem): array => [$arrayItem->value?->class->name, $arrayItem->value?->name->name],
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

    private function getHttpStatus(Return_ $return, array $ast): HttpStatusEnum
    {
        $httpStatus = null;
        foreach ($return->expr->args as $arg) {
            if ($arg->name?->name === 'httpStatus') {
                $httpStatus = $arg;
            }
        }

        if ($httpStatus === null) {
            return HttpStatusEnum::OK;
        }

        $value = $httpStatus->value->name->name;
        $httpStatusClassName = $httpStatus->value->class->name;
        foreach ($ast as $node) {
            if ($node instanceof Namespace_) {
                foreach ($node->stmts as $stmt) {
                    if ($stmt instanceof Use_) {
                        foreach ($stmt->uses as $use) {
                            if ($use->alias === $httpStatusClassName || $use->name->getLast() === $httpStatusClassName) {
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
