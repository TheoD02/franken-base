<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Author;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;

/**
 * @internal
 */
final class AnonymizeBooksTest extends ApiTestCase
{
    public function testAnonymizeAuthorOfBooks(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        for ($i = 0; $i < 10; ++$i) {
            $bookRepository->add(DummyBookFactory::createBook(author: sprintf('author_%d', $i)));
        }

        $response = $client->request('POST', '/api/books/anonymize', [
            'json' => [
                'anonymizedName' => 'anon.',
            ],
        ]);

        $this->assertResponseStatusCodeSame(202);
        $this->assertEmpty($response->getContent());

        foreach ($bookRepository as $book) {
            $this->assertEquals(new Author('anon.'), $book->author());
        }
    }
}
