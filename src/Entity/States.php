<?php

namespace App\Entity;

use App\Repository\StatesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatesRepository::class)]
class States
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameState;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\OneToMany(mappedBy: 'state', targetEntity: Advertisment::class)]
    private $advertisments;

    public function __construct()
    {
        $this->advertisments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameState(): ?string
    {
        return $this->nameState;
    }

    public function setNameState(string $nameState): self
    {
        $this->nameState = $nameState;

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
            $advertisment->setState($this);
        }

        return $this;
    }

    public function removeAdvertisment(Advertisment $advertisment): self
    {
        if ($this->advertisments->removeElement($advertisment)) {
            // set the owning side to null (unless already changed)
            if ($advertisment->getState() === $this) {
                $advertisment->setState(null);
            }
        }

        return $this;
    }
}
