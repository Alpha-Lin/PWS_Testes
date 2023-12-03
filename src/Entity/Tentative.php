<?php

namespace App\Entity;

use App\Repository\TentativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TentativeRepository::class)]
class Tentative
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTentative = null;

    #[ORM\ManyToOne(inversedBy: 'tentatives')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Teste $teste = null;

    #[ORM\ManyToOne(inversedBy: 'Tentatives')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'tentativ', targetEntity: CritereSolution::class)]
    private Collection $critereSolutions;
    /**
    public function __construct(Teste $t)
    {
        $this->critereSolutions = new ArrayCollection();
        $this->teste = t;
    }
**/
    public function __construct()
    {
        $this->critereSolutions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTentative(): ?\DateTimeInterface
    {
        return $this->dateTentative;
    }

    public function setDateTentative(\DateTimeInterface $dateTentative): static
    {
        $this->dateTentative = $dateTentative;

        return $this;
    }

    public function getTeste(): ?Teste
    {
        return $this->teste;
    }

    public function setTeste(?Teste $teste): static
    {
        $this->teste = $teste;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CritereSolution>
     */
    public function getCritereSolutions(): Collection
    {
        return $this->critereSolutions;
    }

    public function addCritereSolution(CritereSolution $critereSolution): static
    {
        if (!$this->critereSolutions->contains($critereSolution)) {
            $this->critereSolutions->add($critereSolution);
            $critereSolution->setTentativ($this);
        }

        return $this;
    }

    public function removeCritereSolution(CritereSolution $critereSolution): static
    {
        if ($this->critereSolutions->removeElement($critereSolution)) {
            // set the owning side to null (unless already changed)
            if ($critereSolution->getTentativ() === $this) {
                $critereSolution->setTentativ(null);
            }
        }

        return $this;
    }
}
