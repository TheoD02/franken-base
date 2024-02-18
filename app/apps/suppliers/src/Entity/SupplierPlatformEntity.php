<?php

declare(strict_types=1);

namespace App\Suppliers\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Suppliers\Repository\WyzCore\SupplierPlatformRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    shortName: 'SupplierPlatform',
)]
#[ORM\Entity(repositoryClass: SupplierPlatformRepository::class)]
#[ORM\Table('supplier_platform')]
class SupplierPlatformEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'boolean')]
    private bool $sendable = true;

    #[ORM\Column(type: 'boolean')]
    private bool $invoiceable = true;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $connector = null;

    #[ORM\Column(type: 'boolean')]
    private bool $wyzOffer = false;

    #[ORM\Column(name: 'platform_id', type: 'integer')]
    private int $platformId;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'supplierPlatforms')]
    #[ORM\JoinColumn(name: 'supplier_id', nullable: false, onDelete: 'CASCADE')]
    private ?SupplierEntity $supplier = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function isSendable(): bool
    {
        return $this->sendable;
    }

    public function setSendable(bool $sendable): self
    {
        $this->sendable = $sendable;

        return $this;
    }

    public function isInvoiceable(): bool
    {
        return $this->invoiceable;
    }

    public function setInvoiceable(bool $invoiceable): self
    {
        $this->invoiceable = $invoiceable;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getConnector(): ?string
    {
        return $this->connector;
    }

    public function setConnector(?string $connector): self
    {
        $this->connector = $connector;

        return $this;
    }

    public function isInquiry(): bool
    {
        if ($this->getConnector() !== null) {
            return true;
        }

        return false;
    }

    public function isWyzOffer(): bool
    {
        return $this->wyzOffer;
    }

    public function setWyzOffer(bool $wyzOffer): self
    {
        $this->wyzOffer = $wyzOffer;

        return $this;
    }

    public function getSupplier(): ?SupplierEntity
    {
        return $this->supplier;
    }

    public function setSupplier(?SupplierEntity $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getPlatformId(): int
    {
        return $this->platformId;
    }

    public function setPlatformId(int $platformId): void
    {
        $this->platformId = $platformId;
    }
}
