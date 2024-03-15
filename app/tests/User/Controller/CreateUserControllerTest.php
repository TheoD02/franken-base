<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\CreateUserController\CreateUserController;
use App\User\Controller\CreateUserController\CreateUserPayload;
use App\User\Serialization\UserGroups;
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
        $this->assertApiResponseEquals($createUserPayload, groups: [UserGroups::READ, UserGroups::READ_ROLES]);
    }
}
