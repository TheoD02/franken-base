<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Factory\UserFactory;
use App\Tests\ControllerTestCase;
use App\Tests\Helper\ProxyToObjectHelper;
use App\User\Controller\GetUserCollectionController\GetUserCollectionController;
use App\User\Serialization\UserGroups;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 */
#[CoversClass(GetUserCollectionController::class)]
class GetCollectionUserControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    private HttpClientInterface&MockObject $jsonPlaceholderClientMock;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->jsonPlaceholderClientMock = $this->createMock(HttpClientInterface::class);
        $this->getContainer()->set('http_client.json_placeholder', $this->jsonPlaceholderClientMock);
    }

    public function testGetCollectionUser(): void
    {
        // Arrange
        $this->jsonPlaceholderClientMock->method('request')->willReturn(new MockResponse('[]'));
        $userCollection = new ArrayCollection(ProxyToObjectHelper::proxyToObject(UserFactory::createMany(2)));

        // Act
        $this->requestAction(GetUserCollectionController::class, '/api/users');

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
