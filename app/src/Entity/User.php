<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\User\Enum\UserRoleEnum;
use App\User\UserGroups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Module\Api\Adapter\ApiDataInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements ApiDataInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([UserGroups::READ])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups([UserGroups::READ])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups([UserGroups::READ])]
    private ?string $email = null;

    /**
     * @var array<UserRoleEnum>
     */
    #[ORM\Column(type: Types::JSON)]
    #[Groups([UserGroups::READ_ROLES])]
    private array $roles = [];

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
    public function getFullName(): ?string
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

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
}
