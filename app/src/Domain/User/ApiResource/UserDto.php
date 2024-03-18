<?php

namespace App\Domain\User\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Domain\Todo\ValueObject\Todo;
use App\Domain\Todo\ValueObject\TodoCollection;
use App\Domain\User\Enum\UserRoleEnum;
use App\Domain\User\Serialization\UserGroups;
use App\Domain\User\ApiState\UserCollectionProvider;
use App\Domain\User\ApiState\UserProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'User',
    operations: [
        new GetCollection(
            uriTemplate: '/userss',
            provider: UserCollectionProvider::class,
        ),
        new Get(
            uriTemplate: '/users/{id}',
            provider: UserProvider::class
        ),
        new Post(
            uriTemplate: '/users',
            input: UserDto::class
        )
    ]
)]
class UserDto
{
    private ?int $id = null;

    private ?string $firstName = null;

    private ?string $lastName = null;

    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var Collection<int, UserRoleEnum> $roles
     */
    private Collection $roles;

    /**
     * @var TodoCollection<int, Todo> $todos
     */
    private TodoCollection $todos;

    public function __construct()
    {
        $this->roles = new ArrayCollection([UserRoleEnum::USER]);
        $this->todos = TodoCollection::empty();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, UserRoleEnum>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * @param Collection<int, UserRoleEnum> $collection
     */
    public function setRoles(Collection $collection): static
    {
        $this->roles = $collection;

        return $this;
    }

    public function getTodos(): TodoCollection
    {
        return $this->todos;
    }

    public function setTodos(TodoCollection $todos): static
    {
        $this->todos = $todos;

        return $this;
    }
}