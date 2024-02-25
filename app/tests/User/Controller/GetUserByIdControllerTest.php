<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\GetUserByIdController;
use App\User\User;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetUserByIdControllerTest extends ControllerTestCase
{
    public function testGetUserById(): void
    {
        // Act
        $this->requestAction(GetUserByIdController::class, uriParameters: [
            'id' => 1,
        ]);

        // Assert
        self::assertResponseStatusCodeSame(200);
        $this->assertApiResponseEquals((new User())->setName('John Doe')->setEmail('john@doe.fr'));
    }
}
