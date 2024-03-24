<?php

declare(strict_types=1);

namespace App\Tests\User\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\User\DummyFactory\DummyUserFactory;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserRoles;
use App\User\Infrastructure\ApiPlatform\Resource\UserResource;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 */
class UserCrudTest extends ApiTestCase
{
    public function testCreateUser(): void
    {
        $client = static::createClient();

        $response = $client->request('POST', '/api/users', [
            'json' => [
                'email' => 'test@email.com',
                'password' => 'password',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(UserResource::class);

        $this->assertJsonContains([
            'email' => 'test@email.com',
            'password' => 'password',
            'roles' => ['ROLE_USER'],
        ]);

        $userId = new UserId(Uuid::fromString(str_replace('/api/users/', '', $response->toArray()['@id'])));

        /** @var User $user */
        $user = self::getContainer()->get(UserRepositoryInterface::class)->ofId($userId);

        $this->assertNotNull($user);
        $this->assertEquals($userId, $user->id());
        $this->assertEquals(new UserEmail('test@email.com'), $user->email());
        $this->assertNotEmpty($user->password());
        $this->assertEquals(new UserRoles([UserRoles::ROLE_USER]), $user->roles());
    }

    public function testCannotCreateUserWithInvalidPayload(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/users', [
            'json' => [
                'email' => 'invalid-email',
                'password' => 'password',
            ],
        ]);

        $this->assertResponseIsUnprocessable();
        $this->assertJsonContains([
            'violations' => [
                [
                    'propertyPath' => 'email',
                    'message' => 'This value is not a valid email address.',
                ],
            ],
        ]);

        $client->request('POST', '/api/users', [
            'json' => [
                'email' => 'invalid-email',
            ],
        ]);

        $this->assertResponseIsUnprocessable();
        $this->assertJsonContains([
            'violations' => [
                [
                    'propertyPath' => 'email',
                    'message' => 'This value is not a valid email address.',
                ],
                [
                    'propertyPath' => 'password',
                    'message' => 'This value should not be null.',
                ],
            ],
        ]);

        $client->request('POST', '/api/users', [
            'json' => [],
        ]);

        $this->assertResponseIsUnprocessable();
        $this->assertJsonContains([
            'violations' => [
                [
                    'propertyPath' => 'email',
                    'message' => 'This value should not be null.',
                ],
                [
                    'propertyPath' => 'password',
                    'message' => 'This value should not be null.',
                ],
            ],
        ]);
    }

    public function testFindUser(): void
    {
        $client = static::createClient();

        /** @var UserRepositoryInterface $userRepository */
        $userRepository = self::getContainer()->get(UserRepositoryInterface::class);

        $user = DummyUserFactory::createUser();
        $userRepository->add($user);

        $client->request('GET', sprintf('/api/users/%s', (string) $user->id()));

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(UserResource::class);

        $this->assertJsonContains([
            'email' => 'test@email.com',
            'password' => 'password', // But should not be returned
            'roles' => ['ROLE_USER'],
        ]);
    }

    public function testFindUsers(): void
    {
        $client = static::createClient();

        /** @var UserRepositoryInterface $userRepository */
        $userRepository = self::getContainer()->get(UserRepositoryInterface::class);

        for ($i = 0; $i < 100; ++$i) {
            $userRepository->add(DummyUserFactory::createUser());
        }

        $client->request('GET', '/api/users');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(UserResource::class);

        $this->assertJsonContains([
            'hydra:totalItems' => 100,
            'hydra:view' => [
                'hydra:first' => '/api/users?page=1',
                'hydra:next' => '/api/users?page=2',
                'hydra:last' => '/api/users?page=4',
            ],
        ]);
    }
}
