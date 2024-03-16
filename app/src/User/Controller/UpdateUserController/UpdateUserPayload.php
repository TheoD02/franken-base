<?php

declare(strict_types=1);

namespace App\User\Controller\UpdateUserController;

use App\User\Entity\UserEntity;
use Symfony\Component\Mapper\Attributes\Map;
use Symfony\Component\Validator\Constraints as Assert;

#[Map(to: UserEntity::class)]
class UpdateUserPayload
{
    #[Assert\NotBlank]
    #[Map(if: 'is_string')]
    public string $firstName;

    #[Assert\NotBlank]
    #[Map(if: 'is_string')]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Map(if: 'is_string')]
    public string $email;
}
