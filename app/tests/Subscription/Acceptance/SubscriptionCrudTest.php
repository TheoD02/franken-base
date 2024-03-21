<?php

declare(strict_types=1);

namespace App\Tests\Subscription\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Subscription\Entity\Subscription;
use App\Tests\Subscription\DummySubscriptionFactory;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 */
final class SubscriptionCrudTest extends ApiTestCase
{
    private static Connection $connection;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$connection = self::getContainer()->get(Connection::class);

        (new Application(self::$kernel))
            ->find('doctrine:database:create')
            ->run(new ArrayInput([
                '--if-not-exists' => true,
            ]), new NullOutput())
        ;

        (new Application(self::$kernel))
            ->find('doctrine:schema:update')
            ->run(new ArrayInput([
                '--force' => true,
            ]), new NullOutput())
        ;
    }

    protected function setUp(): void
    {
        self::$connection->executeStatement('TRUNCATE subscription');
    }

    public function testCreateSubscription(): void
    {
        $client = self::createClient();

        /** @var EntityManagerInterface $em */
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $entityRepository = $em->getRepository(Subscription::class);

        $this->assertSame(0, $entityRepository->count([]));

        $response = $client->request('POST', '/api/subscriptions', [
            'json' => [
                'email' => 'foo@bar.com',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Subscription::class);

        $this->assertJsonContains([
            'email' => 'foo@bar.com',
        ]);

        $uuid = Uuid::fromString(str_replace('/api/subscriptions/', '', (string) $response->toArray()['@id']));

        $subscription = $entityRepository->find($uuid);

        $this->assertNotNull($subscription);
        $this->assertSame('foo@bar.com', $subscription->email);
    }

    public function testDeleteSubscription(): void
    {
        $client = self::createClient();

        /** @var EntityManagerInterface $em */
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $entityRepository = $em->getRepository(Subscription::class);

        $subscription = DummySubscriptionFactory::createSubscription();

        $em->persist($subscription);
        $em->flush();

        $this->assertSame(1, $entityRepository->count([]));

        $response = $client->request('DELETE', sprintf('/api/subscriptions/%s', (string) $subscription->id));

        $this->assertResponseIsSuccessful();
        $this->assertEmpty($response->getContent());

        $this->assertSame(0, $entityRepository->count([]));
    }
}
