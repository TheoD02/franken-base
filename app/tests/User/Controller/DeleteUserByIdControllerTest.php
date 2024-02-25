<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\DeleteUserByIdController;

/**
 * @internal
 *
 * @coversNothing
 */
final class DeleteUserByIdControllerTest extends ControllerTestCase
{
    public function testRemoveUserById(): void
    {
        // Act
        $this->requestAction(DeleteUserByIdController::class, uriParameters: [
            'id' => 1,
        ]);

        // Assert
        self::assertResponseStatusCodeSame(204);
    }
}
