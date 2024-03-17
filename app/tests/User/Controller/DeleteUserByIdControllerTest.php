<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Domain\User\Controller\DeleteUserByIdController;
use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
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
        $this->requestAction(DeleteUserByIdController::class, '/api/users/{id}', uriParameters: [
            'id' => 1,
        ]);

        // Assert
        $this->assertResponseStatusCodeSame(204);
    }
}
