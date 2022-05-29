<?php

namespace App\Entity;

use App\Repository\AdvertismentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertismentRepository::class)]
class Advertisment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $advertismentName;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\Column(type: 'string', length: 255)]
    private $illusttration;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'date')]
    private $AvailibilityDate;

    #[ORM\Column(type: 'date', nullable: true)]
    private $ValidityDate;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $UpdatedAt;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\ManyToOne(targetEntity: AccomodationType::class, inversedBy: 'state')]
    private $accommodationType;

    #[ORM\ManyToOne(targetEntity: States::class, inversedBy: 'advertisments')]
    private $state;

    #[ORM\ManyToOne(targetEntity: RentPeriodation::class, inversedBy: 'advertisments')]
    private $RentsPeriodation;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'advertisments')]
    private $OwnedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdvertismentName(): ?string
    {
        return $this->advertismentName;
    }

    public function setAdvertismentName(string $advertismentName): self
    {
        $this->advertismentName = $advertismentName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getIllusttration(): ?string
    {
        return $this->illusttration;
    }

    public function setIllusttration(string $illusttration): self
    {
        $this->illusttration = $illusttration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAvailibilityDate(): ?\DateTimeInterface
    {
        return $this->AvailibilityDate;
    }

    public function setAvailibilityDate(\DateTimeInterface $AvailibilityDate): self
    {
        $this->AvailibilityDate = $AvailibilityDate;

        return $this;
    }

    public function getValidityDate(): ?\DateTimeInterface
    {
        return $this->ValidityDate;
    }

    public function setValidityDate(?\DateTimeInterface $ValidityDate): self
    {
        $this->ValidityDate = $ValidityDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAccommodationType(): ?AccomodationType
    {
        return $this->accommodationType;
    }

    public function setAccommodationType(?AccomodationType $accommodationType): self
    {
        $this->accommodationType = $accommodationType;

        return $this;
    }

    public function getState(): ?States
    {
        return $this->state;
    }

    public function setState(?States $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getRentsPeriodation(): ?RentPeriodation
    {
        return $this->RentsPeriodation;
    }

    public function setRentsPeriodation(?RentPeriodation $RentsPeriodation): self
    {
        $this->RentsPeriodation = $RentsPeriodation;

        return $this;
    }

    public function getOwnedBy(): ?User
    {
        return $this->OwnedBy;
    }

    public function setOwnedBy(?User $OwnedBy): self
    {
        $this->OwnedBy = $OwnedBy;

        return $this;
    }
}
