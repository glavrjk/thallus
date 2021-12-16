<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $rut;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\ManyToMany(targetEntity=Company::class, inversedBy="person")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="person")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    public function __construct() {
        $this->company = new ArrayCollection();
    }

    public function __toString() {
        return $this->lastName . ' ' . $this->name;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getRut(): ?string {
        return $this->rut;
    }

    public function setRut(string $rut): self {
        $this->rut = $rut;

        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getCompany(): Collection {
        return $this->company;
    }

    public function addCompany(Company $company): self {
        if (!$this->company->contains($company)) {
            $this->company[] = $company;
            $company->addPerson($this);
        }
        return $this;
    }

    public function removeCompany(Company $company): self {
        if ($this->company->contains($company)) {
            $this->company->removeElement($company);
            $company->removePerson($this);
        }
        return $this;
    }

    public function getCountry(): ?Country {
        return $this->country;
    }

    public function setCountry(?Country $country): self {
        $this->country = $country;

        return $this;
    }
}
