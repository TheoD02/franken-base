<?php

declare(strict_types=1);

namespace App\User\Controller\UpdateUserController;

use Symfony\Component\Validator\Constraints as Assert;

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
