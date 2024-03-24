<?php

declare(strict_types=1);

namespace App\User\Infrastructure\ApiPlatform\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\CreateUserCommand;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserPassword;
use App\User\Infrastructure\ApiPlatform\Resource\UserResource;
use Webmozart\Assert\Assert;

/**
 * @implements ProcessorInterface<UserResource, UserResource>
 */
final readonly class CreateUserProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): UserResource
    {
        Assert::isInstanceOf($data, UserResource::class);

        Assert::notNull($data->email);
        Assert::notNull($data->password);

        $command = new CreateUserCommand(email: new UserEmail($data->email), password: new UserPassword($data->password));

        $model = $this->commandBus->dispatch($command);

        return UserResource::fromModel($model);
    }
}
