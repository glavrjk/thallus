<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company {
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
    private $type;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, mappedBy="company")
     */
    private $person;

    public function __construct() {
        $this->person = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(string $type): self {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPerson(): Collection {
        return $this->person;
    }

    public function addPerson(Person $person): self {
        if (!$this->person->contains($person)) {
            $this->person[] = $person;
            $person->addCompany($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self {
        if ($this->person->contains($person)) {
            $this->person->removeElement($person);
            $person->removeCompany($this);
        }

        return $this;
    }
}
