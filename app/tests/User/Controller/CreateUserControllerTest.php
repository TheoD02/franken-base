<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Domain\User\Controller\CreateUserController\CreateUserController;
use App\Domain\User\Controller\CreateUserController\CreateUserPayload;
use App\Domain\User\Serialization\UserGroups;
use App\Tests\ControllerTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 */
#[CoversClass(CreateUserController::class)]
class CreateUserControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testInvokeWithUserCreation(): void
    {
        // Arrange
        $createUserPayload = new CreateUserPayload();
        $createUserPayload->firstName = 'John';
        $createUserPayload->lastName = 'Doe';
        $createUserPayload->email = 'john@doe.fr';

        // Act
        $this->requestAction(CreateUserController::class, '/api/users', requestBody: $createUserPayload);

        // Assert
        $this->assertResponseStatusCodeSame(201);

        $expected = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@doe.fr',
            'roles' => ['user'],
            'fullName' => 'John Doe',
        ];
        $this->assertApiResponseEquals($expected, groups: [UserGroups::READ, UserGroups::READ_ROLES]);
    }
}
