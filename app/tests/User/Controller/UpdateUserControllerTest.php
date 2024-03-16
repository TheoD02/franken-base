<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\UpdateUserController\UpdateUserController;
use App\User\Serialization\UserGroups;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
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
        $this->requestAction(UpdateUserController::class, '/api/users/{id}', uriParameters: [
            'id' => 1,
        ], requestBody: $user);

        // Assert
        $this->assertResponseIsSuccessful();

        $expected = [
            'id' => 1,
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'roles' => ['user'],
            'fullName' => $user->getFirstName() . ' ' . $user->getLastName(),
        ];
        $this->assertApiResponseEquals($expected, groups: [UserGroups::READ, UserGroups::READ_ROLES]);
    }
}
