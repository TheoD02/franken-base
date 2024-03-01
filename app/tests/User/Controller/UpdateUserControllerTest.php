<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\UpdateUserController;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(UpdateUserController::class)]
class UpdateUserControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testUpdateUser(): void
    {
        // Arrange
        $user = UserFactory::createOne()->object();

        // Act
        $this->requestAction(UpdateUserController::class, uriParameters: [
            'id' => 1,
        ], requestBody: $user);

        // Assert
        self::assertResponseIsSuccessful();
        $this->assertApiResponseEquals($user);
    }
}
