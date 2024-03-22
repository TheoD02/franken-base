<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Integration\Doctrine;

use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Infrastructure\Doctrine\AbstractDoctrineBookRepository;
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
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);

        $this->assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);
        self::$em->flush();

        $this->assertCount(1, $repository);
    }

    public function testRemove(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);

        $book = DummyBookFactory::createBook();
        $repository->add($book);
        self::$em->flush();

        $this->assertCount(1, $repository);

        $repository->remove($book);
        self::$em->flush();

        $this->assertEmpty($repository);
    }

    public function testOfId(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);

        $this->assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);
        self::$em->flush();
        self::$em->clear();

        $this->assertEquals($book, $repository->ofId($book->id()));
    }

    public function testWithAuthor(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);

        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorTwo'));

        self::$em->flush();

        $this->assertCount(2, $repository->withAuthor(new Author('authorOne')));
        $this->assertCount(1, $repository->withAuthor(new Author('authorTwo')));
    }

    public function testWithCheapestsFirst(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);

        $repository->add(DummyBookFactory::createBook(price: 1));
        $repository->add(DummyBookFactory::createBook(price: 3));
        $repository->add(DummyBookFactory::createBook(price: 2));

        self::$em->flush();

        $prices = [];
        foreach ($repository->withCheapestsFirst() as $doctrineBookRepository) {
            $prices[] = $doctrineBookRepository->price()->amount;
        }

        $this->assertSame([1, 2, 3], $prices);
    }

    public function testWithPagination(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);
        $this->assertNull($repository->paginator());

        $repository = $repository->withPagination(1, 2);

        $this->assertInstanceOf(DoctrinePaginator::class, $repository->paginator());
    }

    public function testWithoutPagination(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);
        $repository = $repository->withPagination(1, 2);
        $this->assertNotNull($repository->paginator());

        $repository = $repository->withoutPagination();
        $this->assertNull($repository->paginator());
    }

    public function testIteratorWithoutPagination(): void
    {
        $this->markTestSkipped('This test is not working as expected for now, with failing sometimes');
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);
        $this->assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        self::$em->flush();

        $i = 0;
        foreach ($repository as $book) {
            $this->assertSame($books[$i], $book);
            ++$i;
        }
    }

    public function testIteratorWithPagination(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);
        $this->assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];

        foreach ($books as $book) {
            $repository->add($book);
        }

        self::$em->flush();

        $repository = $repository->withPagination(1, 2);

        $i = 0;
        foreach ($repository as $book) {
            $this->assertContains($book, $books);
            ++$i;
        }

        $this->assertSame(2, $i);

        $repository = $repository->withPagination(2, 2);

        $i = 0;
        foreach ($repository as $book) {
            $this->assertContains($book, $books);
            ++$i;
        }

        $this->assertSame(1, $i);
    }

    public function testCount(): void
    {
        /** @var AbstractDoctrineBookRepository $repository */
        $repository = self::getContainer()->get(AbstractDoctrineBookRepository::class);

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        self::$em->flush();

        $this->assertCount(\count($books), $repository);
        $this->assertCount(2, $repository->withPagination(1, 2));
    }
}
