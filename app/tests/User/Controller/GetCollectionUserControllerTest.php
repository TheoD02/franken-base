<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\Tests\Helper\ProxyToObjectHelper;
use App\User\Controller\GetCollectionUserController;
use App\User\Serialization\UserGroups;
use Doctrine\Common\Collections\ArrayCollection;
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
        $userCollection = new ArrayCollection(ProxyToObjectHelper::proxyToObject(UserFactory::createMany(2)));

        // Act
        $this->requestAction(GetCollectionUserController::class, '/api/users');

        // Assert
        $this->assertResponseStatusCodeSame(200);
        $this->assertApiResponseEquals(
            data: [
                [
                    'id' => 1,
                    'firstName' => $userCollection->get(0)->getFirstName(),
                    'lastName' => $userCollection->get(0)->getLastName(),
                    'email' => $userCollection->get(0)->getEmail(),
                    'roles' => ['user'],
                    'fullName' => $userCollection->get(0)->getFirstName() . ' ' . $userCollection->get(0)->getLastName(),
                ],
                [
                    'id' => 2,
                    'firstName' => $userCollection->get(1)->getFirstName(),
                    'lastName' => $userCollection->get(1)->getLastName(),
                    'email' => $userCollection->get(1)->getEmail(),
                    'roles' => ['user'],
                    'fullName' => $userCollection->get(1)->getFirstName() . ' ' . $userCollection->get(1)->getLastName(),
                ],
            ],
            meta: [
                'total' => 2,
                'page' => 1,
                'limit' => 10,
            ],
            groups: [UserGroups::READ]
        );
    }
}
