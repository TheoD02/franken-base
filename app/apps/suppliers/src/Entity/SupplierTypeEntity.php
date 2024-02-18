<?php

declare(strict_types=1);

namespace App\Suppliers\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Suppliers\Repository\WyzCore\SupplierTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    shortName: 'SupplierType',
)]
#[GetCollection]
#[ORM\Entity(repositoryClass: SupplierTypeRepository::class)]
#[ORM\Table('global_supplier_type')]
class SupplierTypeEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nameKey;

    #[ORM\Column(type: 'string', length: 100)]
    private string $descriptionKey;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $lastUpdate = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNameKey(): string
    {
        return $this->nameKey;
    }

    public function setNameKey(string $nameKey): self
    {
        $this->nameKey = $nameKey;

        return $this;
    }

    public function getDescriptionKey(): string
    {
        return $this->descriptionKey;
    }

    public function setDescriptionKey(string $descriptionKey): self
    {
        $this->descriptionKey = $descriptionKey;

        return $this;
    }

    public function getLastUpdate(): ?\DateTime
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(?\DateTime $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
