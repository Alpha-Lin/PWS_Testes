<?php

namespace App\Entity;

use App\Repository\TypeTesteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeTesteRepository::class)]
class TypeTeste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'typeTeste', targetEntity: Teste::class)]
    private Collection $testes;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;


    public function __construct()
    {
        $this->label = new ArrayCollection();
        $this->testes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) $this->label;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Teste>
     */
    public function getTestes(): Collection
    {
        return $this->testes;
    }

    public function addTestis(Teste $testis): static
    {
        if (!$this->testes->contains($testis)) {
            $this->testes->add($testis);
            $testis->setTypeTeste($this);
        }

        return $this;
    }

    public function removeTestis(Teste $testis): static
    {
        if ($this->testes->removeElement($testis)) {
            // set the owning side to null (unless already changed)
            if ($testis->getTypeTeste() === $this) {
                $testis->setTypeTeste(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
