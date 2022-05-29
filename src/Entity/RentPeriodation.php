<?php

namespace App\Entity;

use App\Repository\RentPeriodationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentPeriodationRepository::class)]
class RentPeriodation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $rentPeriodationName;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\OneToMany(mappedBy: 'RentsPeriodation', targetEntity: Advertisment::class)]
    private $advertisments;

    public function __construct()
    {
        $this->advertisments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRentPeriodationName(): ?string
    {
        return $this->rentPeriodationName;
    }

    public function setRentPeriodationName(string $rentPeriodationName): self
    {
        $this->rentPeriodationName = $rentPeriodationName;

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
    public function getAdvertisments(): Collection
    {
        return $this->advertisments;
    }

    public function addAdvertisment(Advertisment $advertisment): self
    {
        if (!$this->advertisments->contains($advertisment)) {
            $this->advertisments[] = $advertisment;
            $advertisment->setRentsPeriodation($this);
        }

        return $this;
    }

    public function removeAdvertisment(Advertisment $advertisment): self
    {
        if ($this->advertisments->removeElement($advertisment)) {
            // set the owning side to null (unless already changed)
            if ($advertisment->getRentsPeriodation() === $this) {
                $advertisment->setRentsPeriodation(null);
            }
        }

        return $this;
    }
}
