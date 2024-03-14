<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\DeleteUserByIdController;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 */
#[CoversClass(DeleteUserByIdController::class)]
class DeleteUserByIdControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testRemoveUserById(): void
    {
        // Arrange
        UserFactory::createOne()->object();

        // Act
        $this->requestAction(DeleteUserByIdController::class, uriParameters: [
            'id' => 1,
        ]);

        // Assert
        $this->assertResponseStatusCodeSame(204);
    }
}
