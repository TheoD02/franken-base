<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\Todo\ValueObject\Todo;
use App\Domain\Todo\ValueObject\TodoCollection;
use App\Domain\User\Enum\UserRoleEnum;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\ValueObject\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Module\Api\Adapter\ApiDataInterface;
use Module\Api\Doctrine\CollectionType;
use Symfony\Component\Mapper\Attributes\Map;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[Map(to: User::class)]
class UserEntity implements ApiDataInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var ArrayCollection<array-key, UserRoleEnum> $roles
     */
    #[ORM\Column(type: CollectionType::NAME)]
    private Collection $roles;

    /**
     * @var TodoCollection<array-key, Todo> $todos
     */
    #[ORM\Column(type: CollectionType::NAME)]
    #[Map(to: 'todos')]
    private TodoCollection $todos;

    public function __construct()
    {
        $this->roles = new ArrayCollection([UserRoleEnum::USER]);
        $this->todos = new TodoCollection();
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
     * @return TodoCollection<array-key, Todo>
     */
    public function getTodos(): TodoCollection
    {
        return $this->todos;
    }

    /**
     * @param TodoCollection<array-key, Todo> $todos
     */
    public function setTodos(TodoCollection $todos): static
    {
        $this->todos = $todos;

        return $this;
    }
}