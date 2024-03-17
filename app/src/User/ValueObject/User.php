<?php

declare(strict_types=1);

namespace App\User\ValueObject;

use App\Todo\ValueObject\Todo;
use App\Todo\ValueObject\TodoCollection;
use App\User\Enum\UserRoleEnum;
use App\User\Serialization\UserGroups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Module\Api\Adapter\ApiDataInterface;
use Module\Api\ValueObject\Identifier;
use Module\Api\ValueObject\IdentifierCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class User implements ApiDataInterface
{
    #[Groups([UserGroups::READ])]
    private ?int $id = null;

    #[Groups([UserGroups::READ])]
    private ?string $firstName = null;

    #[Groups([UserGroups::READ])]
    private ?string $lastName = null;

    #[Groups([UserGroups::READ])]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var ArrayCollection<array-key, UserRoleEnum> $roles
     */
    #[Groups([UserGroups::READ, UserGroups::READ_ROLES])]
    private Collection $roles;

    /**
     * @var TodoCollection<array-key, Todo> $todos
     */
    #[Groups([UserGroups::READ])]
    private Collection $todos;

    public function __construct()
    {
        $this->roles = new ArrayCollection([UserRoleEnum::USER]);
        $this->todos = new TodoCollection();
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

    #[Groups([UserGroups::READ])]
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
     * @return ArrayCollection<array-key, UserRoleEnum>
     */
    public function getRoles(): ArrayCollection
    {
        return $this->roles;
    }

    /**
     * @param ArrayCollection<array-key, UserRoleEnum> $collection
     */
    public function setRoles(ArrayCollection $collection): static
    {
        $this->roles = $collection;

        return $this;
    }

    /**
     * @return IdentifierCollection<array-key, Identifier>|TodoCollection<array-key, Todo>
     */
    public function getTodos(): IdentifierCollection|TodoCollection
    {
        return $this->todos;
    }

    /**
     * @param IdentifierCollection<array-key, Identifier>|TodoCollection<array-key, Todo> $todos
     */
    public function setTodos(IdentifierCollection|TodoCollection $todos): static
    {
        $this->todos = $todos;

        return $this;
    }
}
