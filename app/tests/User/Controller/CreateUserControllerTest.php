<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\User\Controller\CreateUserController;
use App\User\UserGroups;
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
        $expectedUser = UserFactory::createOne()->object();

        $this->requestAction(CreateUserController::class, requestBody: $expectedUser);

        // Assert
        $this->assertResponseIsSuccessful();
        $this->assertApiResponseEquals($expectedUser, groups: [UserGroups::READ, UserGroups::READ_ROLES]);
    }
}
