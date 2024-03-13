<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\Tests\Helper\ProxyToObjectHelper;
use App\User\Controller\GetCollectionUserController;
use App\User\UserCollection;
use App\User\UserGroups;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 */
#[CoversClass(GetCollectionUserController::class)]
class GetCollectionUserControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testGetCollectionUser(): void
    {
        // Arrange
        $userCollection = UserCollection::fromIterable(ProxyToObjectHelper::proxyToObject(UserFactory::createMany(2)));

        // Act
        $this->requestAction(GetCollectionUserController::class);

        // Assert
        $this->assertResponseStatusCodeSame(200);
        $this->assertApiResponseEquals($userCollection, groups: [UserGroups::READ]);
    }
}
