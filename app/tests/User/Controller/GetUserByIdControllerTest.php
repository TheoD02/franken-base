<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\GetUserByIdController;
use App\User\Serialization\UserGroups;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
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
        $this->requestAction(GetUserByIdController::class, '/api/users/{id}', uriParameters: [
            'id' => 1,
        ]);

        // Assert
        $this->assertResponseStatusCodeSame(200);

        $expected = [
            'id' => 1,
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'roles' => ['user'],
            'fullName' => $user->getFirstName() . ' ' . $user->getLastName(),
        ];
        $this->assertApiResponseEquals($expected, groups: [UserGroups::READ]);
    }
}
