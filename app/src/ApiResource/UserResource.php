<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\ApiInput\User\CreateUserInputDto;
use App\ApiInput\User\UpdateUserInputDto;
use App\State\CreateUserProcessor;
use App\State\UpdateUserProcessor;
use App\State\UserCollectionStateProvider;
use App\State\UserStateProvider;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    uriTemplate: '/users',
    shortName: 'User',
    operations: [
        new GetCollection(uriTemplate: '/users', provider: UserCollectionStateProvider::class),
        new Get(uriTemplate: '/users/{id}', provider: UserStateProvider::class),
        new Post(uriTemplate: '/users', input: CreateUserInputDto::class, processor: CreateUserProcessor::class),
        new Delete(uriTemplate: '/users/{id}', input: null, read: false, processor: null),
        new Patch(uriTemplate: '/users/{id}', input: UpdateUserInputDto::class, read: false, processor: UpdateUserProcessor::class),
    ],
)]
class UserResource
{
    private Uuid $id;

    private string $email;

    private string $password;

    private string $name;

    private string $phone;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
