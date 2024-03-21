<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Domain\Exception\MissingBookException;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\Shared\Application\Command\AsCommandHandler;

#[AsCommandHandler]
final readonly class UpdateBookCommandHandler
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {
    }

    public function __invoke(UpdateBookCommand $command): Book
    {
        $book = $this->bookRepository->ofId($command->id);
        if ($book === null) {
            throw new MissingBookException($command->id);
        }

        $book->update(
            name: $command->name,
            description: $command->description,
            author: $command->author,
            content: $command->content,
            price: $command->price,
        );

        return $book;
    }
}
