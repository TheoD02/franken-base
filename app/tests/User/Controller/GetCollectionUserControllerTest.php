<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\GetCollectionUserController;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(GetCollectionUserController::class)]
class GetCollectionUserControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testGetCollectionUser(): void
    {
        // Act
        $this->requestAction(GetCollectionUserController::class);

        // Assert
        $expectedUser = UserFactory::createMany(2);

        /** @var array<mixed> $expectedUser */
        $expectedUser = $this->serializer->normalize($expectedUser);
        self::assertResponseStatusCodeSame(200);
        $this->assertApiResponseEquals($expectedUser);
    }
}
