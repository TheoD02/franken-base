<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\CreateUserController;
use App\User\User;

/**
 * @internal
 *
 * @coversNothing
 */
final class CreateUserControllerTest extends ControllerTestCase
{
    public function testInvokeWithUserCreation(): void
    {
        // Arrange
        $expectedUser = new User();
        $expectedUser->setName('John Doe')
            ->setEmail('john@doe.com')
        ;

        $this->requestAction(CreateUserController::class, requestBody: $expectedUser);

        // Assert
        self::assertResponseIsSuccessful();
        $this->assertApiResponseEquals($expectedUser);
    }
}
