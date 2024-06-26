<?php

declare(strict_types=1);

namespace App\ApiInput\User;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserInputDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    public string $password;

    #[Assert\NotBlank]
    public string $name;

    #[Assert\NotBlank]
    public string $phone;
}
