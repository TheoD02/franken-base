<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Integration\Doctrine;

use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Infrastructure\Doctrine\DoctrineBookRepository;
use App\Shared\Infrastructure\Doctrine\DoctrinePaginator;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * @internal
 */
final class DoctrineBookRepositoryTest extends KernelTestCase
{
    private static EntityManagerInterface $em;

    public static function setUpBeforeClass(): void
    {
        self::bootKernel();

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
        self::$em = self::getContainer()->get(EntityManagerInterface::class);
        self::$em->getConnection()->executeStatement('TRUNCATE book');
    }

    public function testSave(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);

        self::assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);
        self::$em->flush();

        self::assertCount(1, $repository);
    }

    public function testRemove(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);

        $book = DummyBookFactory::createBook();
        $repository->add($book);
        self::$em->flush();

        self::assertCount(1, $repository);

        $repository->remove($book);
        self::$em->flush();

        self::assertEmpty($repository);
    }

    public function testOfId(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);

        self::assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);
        self::$em->flush();
        self::$em->clear();

        self::assertEquals($book, $repository->ofId($book->id()));
    }

    public function testWithAuthor(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);

        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorTwo'));
        self::$em->flush();

        self::assertCount(2, $repository->withAuthor(new Author('authorOne')));
        self::assertCount(1, $repository->withAuthor(new Author('authorTwo')));
    }

    public function testWithCheapestsFirst(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);

        $repository->add(DummyBookFactory::createBook(price: 1));
        $repository->add(DummyBookFactory::createBook(price: 3));
        $repository->add(DummyBookFactory::createBook(price: 2));
        self::$em->flush();

        $prices = [];
        foreach ($repository->withCheapestsFirst() as $book) {
            $prices[] = $book->price()->amount;
        }
        self::assertSame([1, 2, 3], $prices);
    }

    public function testWithPagination(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);
        self::assertNull($repository->paginator());

        $repository = $repository->withPagination(1, 2);

        self::assertInstanceOf(DoctrinePaginator::class, $repository->paginator());
    }

    public function testWithoutPagination(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);
        $repository = $repository->withPagination(1, 2);
        self::assertNotNull($repository->paginator());

        $repository = $repository->withoutPagination();
        self::assertNull($repository->paginator());
    }

    public function testIteratorWithoutPagination(): void
    {
        $this->markTestSkipped('This test is not working as expected for now, with failing sometimes');
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);
        self::assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }
        self::$em->flush();

        $i = 0;
        foreach ($repository as $book) {
            self::assertSame($books[$i], $book);
            ++$i;
        }
    }

    public function testIteratorWithPagination(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);
        self::assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];

        foreach ($books as $book) {
            $repository->add($book);
        }
        self::$em->flush();

        $repository = $repository->withPagination(1, 2);

        $i = 0;
        foreach ($repository as $book) {
            self::assertContains($book, $books);
            ++$i;
        }

        self::assertSame(2, $i);

        $repository = $repository->withPagination(2, 2);

        $i = 0;
        foreach ($repository as $book) {
            self::assertContains($book, $books);
            ++$i;
        }

        self::assertSame(1, $i);
    }

    public function testCount(): void
    {
        /** @var DoctrineBookRepository $repository */
        $repository = self::getContainer()->get(DoctrineBookRepository::class);

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }
        self::$em->flush();

        self::assertCount(\count($books), $repository);
        self::assertCount(2, $repository->withPagination(1, 2));
    }
}
