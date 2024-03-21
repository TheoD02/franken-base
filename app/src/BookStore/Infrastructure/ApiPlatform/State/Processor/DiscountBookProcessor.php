<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\ApiPlatform\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BookStore\Application\Command\DiscountBookCommand;
use App\BookStore\Application\Query\FindBookQuery;
use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Domain\ValueObject\Discount;
use App\BookStore\Infrastructure\ApiPlatform\Payload\DiscountBookPayload;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use Webmozart\Assert\Assert;

/**
 * @implements ProcessorInterface<BookResource>
 */
final readonly class DiscountBookProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): BookResource
    {
        Assert::isInstanceOf($data, DiscountBookPayload::class);

        $bookResource = $context['previous_data'] ?? null;
        Assert::isInstanceOf($bookResource, BookResource::class);

        $discountBookCommand = new DiscountBookCommand(new BookId($bookResource->id), new Discount($data->discountPercentage));

        $this->commandBus->dispatch($discountBookCommand);

        $model = $this->queryBus->ask(new FindBookQuery($discountBookCommand->id));

        return BookResource::fromModel($model);
    }
}
