<?php

declare(strict_types=1);

namespace App\User\ValueObject;

use App\User\Enum\UserRoleEnum;
use App\User\Serialization\UserGroups;
use loophp\collection\Collection;
use Module\Api\Adapter\ApiDataInterface;
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
     * @var Collection<array-key, UserRoleEnum> $roles
     */
    #[Groups([UserGroups::READ_ROLES])]
    private Collection $roles;

    public function __construct()
    {
        $this->roles = Collection::fromIterable([UserRoleEnum::USER]);
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<array-key, UserRoleEnum>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * @param Collection<array-key, UserRoleEnum> $collection
     */
    public function setRoles(Collection $collection): static
    {
        $this->roles = $collection;

        return $this;
    }
}
