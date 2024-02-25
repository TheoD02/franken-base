<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\GetCollectionUserController;
use App\User\User;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(GetCollectionUserController::class)]
class GetCollectionUserControllerTest extends ControllerTestCase
{
    public function testGetCollectionUser(): void
    {
        // Act
        $this->requestAction(GetCollectionUserController::class);

        // Assert
        $expectedUser = [
            (new User())->setName('John Doe')
                ->setEmail('john@doe.fr'),
            (new User())->setName('Alice Cooper')
                ->setEmail('alice@cooper.fr'),
        ];
        $expectedUser = $this->serializer->normalize($expectedUser);
        self::assertResponseStatusCodeSame(200);
        $this->assertApiResponseEquals($expectedUser);
    }
}
