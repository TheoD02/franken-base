<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\ErikRessourceProcessor;
use App\State\ErikRessourceProvider;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(validationContext: ['groups' => ['Default', 'user:create']], input: ErikRessourcePost::class),
        new Get(),
        new Put(),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:create', 'user:update']],
    provider: ErikRessourceProvider::class,
    processor: ErikRessourceProcessor::class,
)]
class ErikRessource
{
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $email = null;

    private ?string $password = null;

    #[Groups(['user:create', 'user:update'])]
    private ?string $plainPassword = null;

    private array $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): ErikRessource
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): ErikRessource
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): ErikRessource
    {
        $this->password = $password;
        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): ErikRessource
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): ErikRessource
    {
        $this->roles = $roles;
        return $this;
    }


}