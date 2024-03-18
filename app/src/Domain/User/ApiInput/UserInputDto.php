<?php

namespace App\Domain\User\ApiInput;

use Symfony\Component\Validator\Constraints as Assert;

class UserInputDto
{
    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
}