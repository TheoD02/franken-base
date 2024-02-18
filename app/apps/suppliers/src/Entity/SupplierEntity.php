<?php

declare(strict_types=1);

namespace App\Suppliers\Entity;

use App\Suppliers\EntityListener\InjectSupplierBehaviorEntityListener;
use App\Suppliers\Enum\SupplierBehavior;
use App\Suppliers\Repository\WyzCore\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
#[ORM\Table('supplier')]
#[ORM\EntityListeners([InjectSupplierBehaviorEntityListener::class])]
class SupplierEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $publicKey;

    #[ORM\Column(length: 50)]
    private string $name;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $active = true;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $groupName = null;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $fileCurrencyId = null;

    #[ORM\Column(nullable: false)]
    private bool $j0;

    #[ORM\Column(type: Types::FLOAT, precision: 10, scale: 6)]
    private float $gpsLat;

    #[ORM\Column(type: Types::FLOAT, precision: 10, scale: 6)]
    private float $gpsLong;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bfZone = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $zip = null;

    #[ORM\Column(length: 255)]
    private string $fileNameToGenerate;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $code = null;

    #[ORM\ManyToOne(fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SupplierTypeEntity $supplierType = null;

    #[ORM\OneToMany(mappedBy: 'supplier', targetEntity: SupplierPlatformEntity::class, orphanRemoval: true)]
    private Collection $supplierPlatforms;

    #[ORM\Column(nullable: true)]
    private ?bool $backOrder = null;

    #[ORM\Column(nullable: true)]
    private ?int $deliveryCountryId = null;

    #[ORM\Column(nullable: true)]
    private ?int $locationCountryId = null;

    private ?SupplierBehavior $supplierBehavior = null;

    public function __construct()
    {
        $this->supplierPlatforms = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function setPublicKey(string $publicKey): SupplierEntity
    {
        $this->publicKey = $publicKey;
        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getGpsLat(): float
    {
        return $this->gpsLat;
    }

    public function setGpsLat(float $gpsLat): self
    {
        $this->gpsLat = $gpsLat;

        return $this;
    }

    public function getGpsLong(): float
    {
        return $this->gpsLong;
    }

    public function setGpsLong(float $gpsLong): self
    {
        $this->gpsLong = $gpsLong;

        return $this;
    }

    public function getFileNameToGenerate(): string
    {
        return $this->fileNameToGenerate;
    }

    public function setFileNameToGenerate(string $fileNameToGenerate): self
    {
        $this->fileNameToGenerate = $fileNameToGenerate;

        return $this;
    }

    public function getSupplierType(): ?SupplierTypeEntity
    {
        return $this->supplierType;
    }

    public function setSupplierType(?SupplierTypeEntity $supplierType): self
    {
        $this->supplierType = $supplierType;

        return $this;
    }

    /**
     * @return Collection<int, SupplierPlatformEntity>
     */
    public function getSupplierPlatforms(): Collection
    {
        return $this->supplierPlatforms;
    }

    public function getSupplierPlatform(int $id): ?SupplierPlatformEntity
    {
        $supplierPlatform = $this->supplierPlatforms->filter(
            function (SupplierPlatformEntity $supplierPlatform) use ($id) {
                return $supplierPlatform->getPlatformId() === $id;
            }
        )->first();
        return $supplierPlatform ?: null;
    }

    public function addSupplierPlatform(SupplierPlatformEntity $supplierPlatform): self
    {
        if (!$this->supplierPlatforms->contains($supplierPlatform)) {
            $this->supplierPlatforms->add($supplierPlatform);
            $supplierPlatform->setSupplier($this);
        }

        return $this;
    }

    public function removeSupplierPlatform(SupplierPlatformEntity $supplierPlatform): self
    {
        if ($this->supplierPlatforms->removeElement($supplierPlatform)) {
            // set the owning side to null (unless already changed)
            if ($supplierPlatform->getSupplier() === $this) {
                $supplierPlatform->setSupplier(null);
            }
        }

        return $this;
    }

    public function isJ0(): bool
    {
        return $this->j0;
    }

    public function setJ0(bool $j0): self
    {
        $this->j0 = $j0;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getLocationCountryId(): ?int
    {
        return $this->locationCountryId;
    }

    public function setLocationCountryId(?int $locationCountryId): self
    {
        $this->locationCountryId = $locationCountryId;

        return $this;
    }

    public function getDeliveryCountryId(): ?int
    {
        return $this->deliveryCountryId;
    }

    public function setDeliveryCountryId(?int $deliveryCountryId): self
    {
        $this->deliveryCountryId = $deliveryCountryId;

        return $this;
    }

    public function isBackOrder(): ?bool
    {
        return $this->backOrder;
    }

    public function getBackOrder(): ?bool
    {
        return $this->backOrder;
    }

    public function setBackOrder(?bool $backOrder): self
    {
        $this->backOrder = $backOrder;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBfZone(): ?string
    {
        return $this->bfZone;
    }

    public function setBfZone(?string $bfZone): self
    {
        $this->bfZone = $bfZone;

        return $this;
    }

    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    public function setGroupName(?string $groupName): self
    {
        $this->groupName = $groupName;

        return $this;
    }

    public function getFileCurrencyId(): ?int
    {
        return $this->fileCurrencyId;
    }

    public function setFileCurrencyId(?int $fileCurrencyId): void
    {
        $this->fileCurrencyId = $fileCurrencyId;
    }

    public function getSupplierBehavior(): ?SupplierBehavior
    {
        return $this->supplierBehavior;
    }

    public function setSupplierBehavior(?SupplierBehavior $supplierBehavior): SupplierEntity
    {
        $this->supplierBehavior = $supplierBehavior;
        return $this;
    }
}
