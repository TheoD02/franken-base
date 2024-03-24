<?php

namespace App\User\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\User\Domain\Model\User;
use App\User\Infrastructure\ApiPlatform\State\Processor\CreateUserProcessor;
use App\User\Infrastructure\ApiPlatform\State\Provider\UserCollectionProvider;
use App\User\Infrastructure\ApiPlatform\State\Provider\UserItemProvider;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'User',
    operations: [
        // queries
        new GetCollection(provider: UserCollectionProvider::class),
        new Get(provider: UserItemProvider::class),
        new Post(denormalizationContext: ['groups' => [self::POST_CREATE]], processor: CreateUserProcessor::class),
    ]
)]
class UserResource
{
    public const POST_CREATE = 'user:post:create';

    /**
     * @param array<string>|null $roles
     */
    public function __construct(
        #[ApiProperty(readable: false, writable: false, identifier: true)]
        public ?AbstractUid $id = null,

        #[Assert\NotNull]
        #[Assert\Email]
        #[Groups([self::POST_CREATE])]
        public ?string $email = null,

        #[Groups([self::POST_CREATE])]
        #[Assert\NotNull]
        public ?string $password = null,

        public ?array $roles = null,
    ) {
    }

    public static function fromModel(User $model): self
    {
        return new self(
            $model->id()->value,
            $model->email()->value,
            $model->password()->value,
            $model->roles()->value,
        );
    }
}
