<?php

declare(strict_types=1);

namespace App\User\Controller\CreateUserController;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserPayload
{
    #[Assert\NotBlank]
    public string $firstName = '';

    #[Assert\NotBlank]
    public string $lastName = '';

    #[Assert\Email]
    public string $email = '';
}
