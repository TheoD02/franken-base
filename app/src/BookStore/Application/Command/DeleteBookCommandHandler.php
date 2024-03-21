<?php

declare(strict_types=1);

namespace App\BookStore\Application\Command;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\Shared\Application\Command\AsCommandHandler;

#[AsCommandHandler]
final readonly class DeleteBookCommandHandler
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {
    }

    public function __invoke(DeleteBookCommand $command): void
    {
        if (! ($book = $this->bookRepository->ofId($command->id)) instanceof Book) {
            return;
        }

        $this->bookRepository->remove($book);
    }
}
