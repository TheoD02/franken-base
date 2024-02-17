<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A means for accessing a service, e.g. a government office location, web site, or phone number.
 *
 * @see https://schema.org/ServiceChannel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ServiceChannel'])]
class ServiceChannel extends Intangible
{
    /**
     * A language someone may use with or at the item, service or place. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[inLanguage\]\].
     *
     * @see https://schema.org/availableLanguage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Language')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/availableLanguage'])]
    #[Assert\NotNull]
    private Language $availableLanguage;

    /**
     * The website to access the service.
     *
     * @see https://schema.org/serviceUrl
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/serviceUrl'])]
    #[Assert\Url]
    private ?string $serviceUrl = null;

    /**
     * Estimated processing time for the service using this channel.
     *
     * @see https://schema.org/processingTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/processingTime'])]
    #[Assert\NotNull]
    private Duration $processingTime;

    /**
     * The phone number to use to access the service.
     *
     * @see https://schema.org/servicePhone
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
    #[ApiProperty(types: ['https://schema.org/servicePhone'])]
    private ?ContactPoint $servicePhone = null;

    /**
     * The service provided by this channel.
     *
     * @see https://schema.org/providesService
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Service')]
    #[ApiProperty(types: ['https://schema.org/providesService'])]
    private ?Service $providesService = null;

    /**
     * The number to access the service by text message.
     *
     * @see https://schema.org/serviceSmsNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ContactPoint')]
    #[ApiProperty(types: ['https://schema.org/serviceSmsNumber'])]
    private ?ContactPoint $serviceSmsNumber = null;

    /**
     * The address for accessing the service by mail.
     *
     * @see https://schema.org/servicePostalAddress
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ApiProperty(types: ['https://schema.org/servicePostalAddress'])]
    private ?PostalAddress $servicePostalAddress = null;

    /**
     * The location (e.g. civic structure, local business, etc.) where a person can go to access the service.
     *
     * @see https://schema.org/serviceLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ApiProperty(types: ['https://schema.org/serviceLocation'])]
    private ?Place $serviceLocation = null;

    public function setAvailableLanguage(Language $availableLanguage): void
    {
        $this->availableLanguage = $availableLanguage;
    }

    public function getAvailableLanguage(): Language
    {
        return $this->availableLanguage;
    }

    public function setServiceUrl(?string $serviceUrl): void
    {
        $this->serviceUrl = $serviceUrl;
    }

    public function getServiceUrl(): ?string
    {
        return $this->serviceUrl;
    }

    public function setProcessingTime(Duration $processingTime): void
    {
        $this->processingTime = $processingTime;
    }

    public function getProcessingTime(): Duration
    {
        return $this->processingTime;
    }

    public function setServicePhone(?ContactPoint $servicePhone): void
    {
        $this->servicePhone = $servicePhone;
    }

    public function getServicePhone(): ?ContactPoint
    {
        return $this->servicePhone;
    }

    public function setProvidesService(?Service $providesService): void
    {
        $this->providesService = $providesService;
    }

    public function getProvidesService(): ?Service
    {
        return $this->providesService;
    }

    public function setServiceSmsNumber(?ContactPoint $serviceSmsNumber): void
    {
        $this->serviceSmsNumber = $serviceSmsNumber;
    }

    public function getServiceSmsNumber(): ?ContactPoint
    {
        return $this->serviceSmsNumber;
    }

    public function setServicePostalAddress(?PostalAddress $servicePostalAddress): void
    {
        $this->servicePostalAddress = $servicePostalAddress;
    }

    public function getServicePostalAddress(): ?PostalAddress
    {
        return $this->servicePostalAddress;
    }

    public function setServiceLocation(?Place $serviceLocation): void
    {
        $this->serviceLocation = $serviceLocation;
    }

    public function getServiceLocation(): ?Place
    {
        return $this->serviceLocation;
    }
}
