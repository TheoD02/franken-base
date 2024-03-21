<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Price;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;

/**
 * @internal
 */
final class DiscountBookTest extends ApiTestCase
{
    public function testApplyADiscountOnBook(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook(price: 1000);
        $bookRepository->add($book);

        $client->request('POST', sprintf('/api/books/%s/discount', $book->id()), [
            'json' => [
                'discountPercentage' => 20,
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);
        $this->assertJsonContains([
            'price' => 800,
        ]);

        $this->assertEquals(new Price(800), $bookRepository->ofId($book->id())->price());
    }

    public function testValidateDiscountAmount(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook(price: 1000);
        $bookRepository->add($book);

        $client->request('POST', sprintf('/api/books/%s/discount', $book->id()), [
            'json' => [
                'discountPercentage' => 200,
            ],
        ]);

        $this->assertResponseIsUnprocessable();
        $this->assertJsonContains([
            'violations' => [
                [
                    'propertyPath' => 'discountPercentage',
                    'message' => 'This value should be between 0 and 100.',
                ],
            ],
        ]);

        $this->assertEquals(new Price(1000), $bookRepository->ofId($book->id())->price());
    }
}
