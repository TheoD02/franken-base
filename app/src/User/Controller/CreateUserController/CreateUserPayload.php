<?php

declare(strict_types=1);

namespace App\User\Controller\CreateUserController;

use App\User\Entity\UserEntity;
use Symfony\Component\Mapper\Attributes\Map;
use Symfony\Component\Validator\Constraints as Assert;

#[Map(to: UserEntity::class)]
class CreateUserPayload
{
    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
}
