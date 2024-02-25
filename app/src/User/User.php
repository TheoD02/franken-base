<?php

declare(strict_types=1);

namespace App\User;

use App\User\Enum\UserRoleEnum;
use loophp\collection\Collection;
use Module\Api\Adapter\ApiDataInterface;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use Symfony\Component\Validator\Constraints as Assert;

#[Response]
class User implements ApiDataInterface
{
    #[Property(description: 'The name of the user.')]
    private string $name;

    #[Property(description: 'The email of the user.', format: 'email')]
    #[Assert\Email]
    private string $email;

    /**
     * @var Collection<UserRoleEnum>
     */
    #[Property(
        description: 'The roles of the user.',
        type: 'array',
        items: new Items(description: 'The role of the user.', enum: UserRoleEnum::class, example: UserRoleEnum::ADMIN),
    )]
    private Collection $roles;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function setRoles(Collection $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
