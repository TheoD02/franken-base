<?php

namespace App\Dto;

use App\Enum\UserStatusEnum;
use OpenApi\Attributes\Property;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class User
{
    public const USER_PRIVATE = 'private';
    public const USER_PUBLIC = 'public';

    #[Assert\Length(min: 3, max: 50)]
    #[Groups([User::USER_PRIVATE, User::USER_PUBLIC])]
    public string $name;

    #[Assert\Email]
    #[Groups([User::USER_PRIVATE])]
    public string $email;

    #[Groups([User::USER_PRIVATE])]
    #[Property(description: 'The status of the user', enum: UserStatusEnum::class)]
    public UserStatusEnum $status;

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

    public function getStatus(): UserStatusEnum
    {
        return $this->status;
    }

    public function setStatus(UserStatusEnum $status): User
    {
        $this->status = $status;
        return $this;
    }
}