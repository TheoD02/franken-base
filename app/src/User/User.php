<?php

namespace App\User;

use App\Api\Adapter\ApiDataInterface;
use App\User\Enum\UserRoleEnum;
use loophp\collection\Collection;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use Symfony\Component\Validator\Constraints as Assert;

#[Response]
class User implements ApiDataInterface
{
    #[Property(description: 'The name of the user.')]
    private string $name;

    #[Property(description: 'The email of the user.')]
    #[Assert\Email]
    private string $email;

    /**
     * @var Collection<UserRoleEnum>
     */
    #[Property(
        description: 'The roles of the user.',
        type: 'array',
        items: new Items(
            description: 'The role of the user.',
            enum: UserRoleEnum::class,
            example: UserRoleEnum::ADMIN,
        ),
    )]
    private Collection $roles;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function setRoles(Collection $roles): User
    {
        $this->roles = $roles;
        return $this;
    }
}