<?php

namespace App\Entity;

use App\Repository\TypeTesteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeTesteRepository::class)]
class TypeTeste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'typeTeste', targetEntity: Teste::class, orphanRemoval: true)]
    private Collection $label;

    public function __construct()
    {
        $this->label = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Teste>
     */
    public function getLabel(): Collection
    {
        return $this->label;
    }

    public function addLabel(Teste $label): static
    {
        if (!$this->label->contains($label)) {
            $this->label->add($label);
            $label->setTypeTeste($this);
        }

        return $this;
    }

    public function removeLabel(Teste $label): static
    {
        if ($this->label->removeElement($label)) {
            // set the owning side to null (unless already changed)
            if ($label->getTypeTeste() === $this) {
                $label->setTypeTeste(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->label;
    }
}
