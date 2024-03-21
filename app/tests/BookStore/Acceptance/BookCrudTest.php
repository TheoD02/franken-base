<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Domain\ValueObject\BookContent;
use App\BookStore\Domain\ValueObject\BookDescription;
use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 */
final class BookCrudTest extends ApiTestCase
{
    public function testReturnPaginatedBooks(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        for ($i = 0; $i < 100; ++$i) {
            $bookRepository->add(DummyBookFactory::createBook());
        }

        $client->request('GET', '/api/books');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);

        $this->assertJsonContains([
            'hydra:totalItems' => 100,
            'hydra:view' => [
                'hydra:first' => '/api/books?page=1',
                'hydra:next' => '/api/books?page=2',
                'hydra:last' => '/api/books?page=4',
            ],
        ]);
    }

    public function testFilterBooksByAuthor(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $bookRepository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $bookRepository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $bookRepository->add(DummyBookFactory::createBook(author: 'authorTwo'));

        $client->request('GET', '/api/books?author=authorOne');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);

        $this->assertJsonContains([
            'hydra:member' => [
                [
                    'author' => 'authorOne',
                ],
                [
                    'author' => 'authorOne',
                ],
            ],
            'hydra:totalItems' => 2,
        ]);
    }

    public function testReturnBook(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook(name: 'name', description: 'description', author: 'author', content: 'content', price: 1000);
        $bookRepository->add($book);

        $client->request('GET', sprintf('/api/books/%s', (string) $book->id()));

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);

        $this->assertJsonContains([
            'name' => 'name',
            'description' => 'description',
            'author' => 'author',
            'content' => 'content',
            'price' => 1000,
        ]);
    }

    public function testCreateBook(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', '/api/books', [
            'json' => [
                'name' => 'name',
                'description' => 'description',
                'author' => 'author',
                'content' => 'content',
                'price' => 1000,
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);

        $this->assertJsonContains([
            'name' => 'name',
            'description' => 'description',
            'author' => 'author',
            'content' => 'content',
            'price' => 1000,
        ]);

        $bookId = new BookId(Uuid::fromString(str_replace('/api/books/', '', (string) $response->toArray()['@id'])));

        $book = self::getContainer()->get(BookRepositoryInterface::class)->ofId($bookId);

        $this->assertNotNull($book);
        $this->assertEquals($bookId, $book->id());
        $this->assertEquals(new BookName('name'), $book->name());
        $this->assertEquals(new BookDescription('description'), $book->description());
        $this->assertEquals(new Author('author'), $book->author());
        $this->assertEquals(new BookContent('content'), $book->content());
        $this->assertEquals(new Price(1000), $book->price());
    }

    public function testCannotCreateBookWithoutValidPayload(): void
    {
        $client = self::createClient();

        $client->request('POST', '/api/books', [
            'json' => [
                'name' => '',
                'description' => '',
                'author' => '',
                'content' => '',
                'price' => -100,
            ],
        ]);

        $this->assertResponseIsUnprocessable();
        $this->assertJsonContains([
            'violations' => [
                [
                    'propertyPath' => 'name',
                    'message' => 'This value is too short. It should have 1 character or more.',
                ],
                [
                    'propertyPath' => 'description',
                    'message' => 'This value is too short. It should have 1 character or more.',
                ],
                [
                    'propertyPath' => 'author',
                    'message' => 'This value is too short. It should have 1 character or more.',
                ],
                [
                    'propertyPath' => 'content',
                    'message' => 'This value is too short. It should have 1 character or more.',
                ],
                [
                    'propertyPath' => 'price',
                    'message' => 'This value should be either positive or zero.',
                ],
            ],
        ]);

        $client->request('POST', '/api/books', [
            'json' => [],
        ]);

        $this->assertResponseIsUnprocessable();
        $this->assertJsonContains([
            'violations' => [
                [
                    'propertyPath' => 'name',
                    'message' => 'This value should not be null.',
                ],
                [
                    'propertyPath' => 'description',
                    'message' => 'This value should not be null.',
                ],
                [
                    'propertyPath' => 'author',
                    'message' => 'This value should not be null.',
                ],
                [
                    'propertyPath' => 'content',
                    'message' => 'This value should not be null.',
                ],
                [
                    'propertyPath' => 'price',
                    'message' => 'This value should not be null.',
                ],
            ],
        ]);
    }

    public function testUpdateBook(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook();
        $bookRepository->add($book);

        $client->request('PUT', sprintf('/api/books/%s', $book->id()), [
            'json' => [
                'name' => 'newName',
                'description' => 'newDescription',
                'author' => 'newAuthor',
                'content' => 'newContent',
                'price' => 2000,
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);

        $this->assertJsonContains([
            'name' => 'newName',
            'description' => 'newDescription',
            'author' => 'newAuthor',
            'content' => 'newContent',
            'price' => 2000,
        ]);

        $updatedBook = $bookRepository->ofId($book->id());

        $this->assertNotNull($book);
        $this->assertEquals(new BookName('newName'), $updatedBook->name());
        $this->assertEquals(new BookDescription('newDescription'), $updatedBook->description());
        $this->assertEquals(new Author('newAuthor'), $updatedBook->author());
        $this->assertEquals(new BookContent('newContent'), $updatedBook->content());
        $this->assertEquals(new Price(2000), $updatedBook->price());
    }

    public function testPartiallyUpdateBook(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook(name: 'name', description: 'description');
        $bookRepository->add($book);

        $client->request('PATCH', sprintf('/api/books/%s', $book->id()), [
            'headers' => [
                'Content-Type' => 'application/merge-patch+json',
            ],
            'json' => [
                'name' => 'newName',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);

        $this->assertJsonContains([
            'name' => 'newName',
        ]);

        $updatedBook = $bookRepository->ofId($book->id());

        $this->assertNotNull($book);
        $this->assertEquals(new BookName('newName'), $updatedBook->name());
        $this->assertEquals(new BookDescription('description'), $updatedBook->description());
    }

    public function testDeleteBook(): void
    {
        $client = self::createClient();

        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        $book = DummyBookFactory::createBook();
        $bookRepository->add($book);

        $response = $client->request('DELETE', sprintf('/api/books/%s', $book->id()));

        $this->assertResponseIsSuccessful();
        $this->assertEmpty($response->getContent());

        $this->assertNull($bookRepository->ofId($book->id()));
    }
}
