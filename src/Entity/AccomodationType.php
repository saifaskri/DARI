<?php

namespace App\Entity;

use App\Repository\AccomodationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccomodationTypeRepository::class)]
class AccomodationType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $accomodationTypeName;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\OneToMany(mappedBy: 'accommodationType', targetEntity: Advertisment::class)]
    private $advertisments;

    public function __construct()
    {
        $this->advertisments = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getAccomodationTypeName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccomodationTypeName(): ?string
    {
        return $this->accomodationTypeName;
    }

    public function setAccomodationTypeName(string $accomodationTypeName): self
    {
        $this->accomodationTypeName = $accomodationTypeName;

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

    /**
     * @return Collection<int, Advertisment>
     */
    public function getadvertisments(): Collection
    {
        return $this->advertisments;
    }

    public function addadvertisments(Advertisment $advertisments): self
    {
        if (!$this->advertisments->contains($advertisments)) {
            $this->advertisments[] = $advertisments;
            $advertisments->setAccommodationType($this);
        }

        return $this;
    }

    public function removeadvertisments(Advertisment $advertisments): self
    {
        if ($this->advertisments->removeElement($advertisments)) {
            // set the owning side to null (unless already changed)
            if ($advertisments->getAccommodationType() === $this) {
                $advertisments->setAccommodationType(null);
            }
        }

        return $this;
    }
}
