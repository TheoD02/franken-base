<?php

declare(strict_types=1);

namespace App\Domain\User\Controller\UpdateUserController;

use App\Domain\User\Entity\UserEntity;
use Symfony\Component\Mapper\Attributes\Map;
use Symfony\Component\Validator\Constraints as Assert;

#[Map(to: UserEntity::class)]
class UpdateUserPayload
{
    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
}
