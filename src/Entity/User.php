<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $FirstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $LastName;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    private $UserImg;

    #[ORM\Column(type: 'datetime')]
    private $CreatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $UpdatedAt;

    #[ORM\Column(type: 'boolean')]
    private $Status;

    #[ORM\Column(type: 'date', nullable: true)]
    private $BirthDAY;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Tel;

    #[ORM\Column(type: 'string', length: 255)]
    private $Gender;

    #[ORM\OneToMany(mappedBy: 'OwnedBy', targetEntity: Advertisment::class)]
    private $advertisments;

    public function __construct()
    {
        $this->advertisments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getUserImg(): ?string
    {
        return $this->UserImg;
    }

    public function setUserImg(string $UserImg): self
    {
        $this->UserImg = $UserImg;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

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
        return $this->Status;
    }

    public function setStatus(bool $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getBirthDAY(): ?\DateTimeInterface
    {
        return $this->BirthDAY;
    }

    public function setBirthDAY(?\DateTimeInterface $BirthDAY): self
    {
        $this->BirthDAY = $BirthDAY;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(?string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

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
            $advertisment->setOwnedBy($this);
        }

        return $this;
    }

    public function removeAdvertisment(Advertisment $advertisment): self
    {
        if ($this->advertisments->removeElement($advertisment)) {
            // set the owning side to null (unless already changed)
            if ($advertisment->getOwnedBy() === $this) {
                $advertisment->setOwnedBy(null);
            }
        }

        return $this;
    }
}
