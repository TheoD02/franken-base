<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\ApiPlatform\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\Command\UpdateBookCommand;
use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Domain\ValueObject\BookContent;
use App\BookStore\Domain\ValueObject\BookDescription;
use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Shared\Application\Command\CommandBusInterface;
use Webmozart\Assert\Assert;

/**
 * @implements ProcessorInterface<BookResource>
 */
final readonly class UpdateBookProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): BookResource
    {
        Assert::isInstanceOf($data, BookResource::class);

        $bookResource = $context['previous_data'] ?? null;
        Assert::isInstanceOf($bookResource, BookResource::class);

        $command = new UpdateBookCommand(
            new BookId($bookResource->id),
            $data->name !== null ? new BookName($data->name) : null,
            $data->description !== null ? new BookDescription($data->description) : null,
            $data->author !== null ? new Author($data->author) : null,
            $data->content !== null ? new BookContent($data->content) : null,
            $data->price !== null ? new Price($data->price) : null,
        );

        $model = $this->commandBus->dispatch($command);

        return BookResource::fromModel($model);
    }
}
