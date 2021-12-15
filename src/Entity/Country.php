<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country {
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
    private $code;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Person::class, mappedBy="country")
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

    public function getCode(): ?string {
        return $this->code;
    }

    public function setCode(string $code): self {
        $this->code = $code;

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
            $person->setCountry($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self {
        if ($this->person->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getCountry() === $this) {
                $person->setCountry(null);
            }
        }

        return $this;
    }
}
