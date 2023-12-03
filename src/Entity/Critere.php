<?php

namespace App\Entity;

use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritereRepository::class)]
class Critere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $scoreMax = null;

    #[ORM\Column]
    private ?float $scoreDefaut = null;

    #[ORM\ManyToOne(inversedBy: 'criteres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Teste $teste = null;

    #[ORM\Column(length: 255)]
    private ?string $interpretationMaxTexte = null;

    #[ORM\Column(length: 255)]
    private ?string $interpretationMinTexte = null;

    #[ORM\Column]
    private ?int $interpretationMaxCouleur = null;

    #[ORM\Column]
    private ?int $interpretationMinCouleur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private $interpretationMaxImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private $interpretationMinImage = null;

    #[ORM\OneToMany(mappedBy: 'critere', targetEntity: Solution::class)]
    private Collection $solutions;

    #[ORM\OneToMany(mappedBy: 'critere', targetEntity: CritereSolution::class)]
    private Collection $critereSolutions;

    public function __construct()
    {
        $this->solutions = new ArrayCollection();
        $this->critereSolutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScoreMax(): ?float
    {
        return $this->scoreMax;
    }

    public function setScoreMax(float $scoreMax): static
    {
        $this->scoreMax = $scoreMax;

        return $this;
    }

    public function getScoreDefaut(): ?float
    {
        return $this->scoreDefaut;
    }

    public function setScoreDefaut(float $scoreDefaut): static
    {
        $this->scoreDefaut = $scoreDefaut;

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

    public function getInterpretationMaxTexte(): ?string
    {
        return $this->interpretationMaxTexte;
    }

    public function setInterpretationMaxTexte(string $interpretationMaxTexte): static
    {
        $this->interpretationMaxTexte = $interpretationMaxTexte;

        return $this;
    }

    public function getInterpretationMinTexte(): ?string
    {
        return $this->interpretationMinTexte;
    }

    public function setInterpretationMinTexte(string $interpretationMinTexte): static
    {
        $this->interpretationMinTexte = $interpretationMinTexte;

        return $this;
    }

    public function getInterpretationMaxCouleur(): ?int
    {
        return $this->interpretationMaxCouleur;
    }

    public function setInterpretationMaxCouleur(int $interpretationMaxCouleur): static
    {
        $this->interpretationMaxCouleur = $interpretationMaxCouleur;

        return $this;
    }

    public function getInterpretationMinCouleur(): ?int
    {
        return $this->interpretationMinCouleur;
    }

    public function setInterpretationMinCouleur(int $interpretationMinCouleur): static
    {
        $this->interpretationMinCouleur = $interpretationMinCouleur;

        return $this;
    }

    public function getInterpretationMaxImage(): ?string
    {
        return $this->interpretationMaxImage;
    }

    public function setInterpretationMaxImage(string $interpretationMaxImage): static
    {
        $this->interpretationMaxImage = $interpretationMaxImage;

        return $this;
    }

    public function getInterpretationMinImage(): ?string
    {
        return $this->interpretationMinImage;
    }

    public function setInterpretationMinImage(string $interpretationMinImage): static
    {
        $this->interpretationMinImage = $interpretationMinImage;

        return $this;
    }

    /**
     * @return Collection<int, Solution>
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solution $solution): static
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions->add($solution);
            $solution->setCritere($this);
        }

        return $this;
    }

    public function removeSolution(Solution $solution): static
    {
        if ($this->solutions->removeElement($solution)) {
            // set the owning side to null (unless already changed)
            if ($solution->getCritere() === $this) {
                $solution->setCritere(null);
            }
        }

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
            $critereSolution->setCritere($this);
        }

        return $this;
    }

    public function removeCritereSolution(CritereSolution $critereSolution): static
    {
        if ($this->critereSolutions->removeElement($critereSolution)) {
            // set the owning side to null (unless already changed)
            if ($critereSolution->getCritere() === $this) {
                $critereSolution->setCritere(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return "Critère n°" . $this->id;
    }
}
