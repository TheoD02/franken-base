<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\UpdateUserController;
use App\User\User;

/**
 * @internal
 *
 * @coversNothing
 */
final class UpdateUserControllerTest extends ControllerTestCase
{
    public function testUpdateUser(): void
    {
        // Arrange
        $user = (new User())
            ->setName('John Doe')
            ->setEmail('john@doe.fr')
        ;

        // Act
        $this->requestAction(UpdateUserController::class, uriParameters: [
            'id' => 1,
        ], requestBody: $user);

        // Assert
        self::assertResponseIsSuccessful();
        $this->assertApiResponseEquals($user);
    }
}
