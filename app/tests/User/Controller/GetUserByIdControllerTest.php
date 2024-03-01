<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\GetUserByIdController;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(GetUserByIdController::class)]
class GetUserByIdControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testGetUserById(): void
    {
        // Arrange
        $user = UserFactory::createOne()->object();

        // Act
        $this->requestAction(GetUserByIdController::class, uriParameters: [
            'id' => 1,
        ]);

        // Assert
        self::assertResponseStatusCodeSame(200);
        $this->assertApiResponseEquals($user);
    }
}
