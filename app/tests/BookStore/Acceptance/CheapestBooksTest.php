<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;

/**
 * @internal
 */
final class CheapestBooksTest extends ApiTestCase
{
    public function testReturnOnlyTheTenCheapestBooks(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        for ($i = 0; $i < 20; ++$i) {
            $bookRepository->add(DummyBookFactory::createBook(price: $i));
        }

        $response = $client->request('GET', '/api/books/cheapest');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);

        $this->assertSame(10, $response->toArray()['hydra:totalItems']);

        $prices = [];
        for ($i = 0; $i < 10; ++$i) {
            $prices[] = [
                'price' => $i,
            ];
        }

        $this->assertJsonContains([
            'hydra:member' => $prices,
        ]);
    }

    public function testReturnBooksSortedByPrice(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $prices = [2000, 1000, 3000];
        foreach ($prices as $price) {
            $bookRepository->add(DummyBookFactory::createBook(price: $price));
        }

        $response = $client->request('GET', '/api/books/cheapest');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);

        $responsePrices = array_map(static fn (array $bookData): int => $bookData['price'], $response->toArray()['hydra:member']);
        $this->assertSame([1000, 2000, 3000], $responsePrices);
    }
}
