<?php

namespace App\Entity;

use App\Repository\SolutionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolutionRepository::class)]
class Solution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSolution = null;

    #[ORM\ManyToOne(inversedBy: 'solutions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $Question = null;

    #[ORM\ManyToMany(targetEntity: Tentative::class, inversedBy: 'solutions')]
    private Collection $tentatives;

    #[ORM\ManyToMany(targetEntity: Critere::class, mappedBy: 'solutions')]
    private Collection $criteres;

    public function __construct()
    {
        $this->tentatives = new ArrayCollection();
        $this->criteres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSolution(): ?string
    {
        return $this->nomSolution;
    }

    public function setNomSolution(string $nomSolution): static
    {
        $this->nomSolution = $nomSolution;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->Question;
    }

    public function setQuestion(?Question $Question): static
    {
        $this->Question = $Question;

        return $this;
    }

    /**
     * @return Collection<int, Tentative>
     */
    public function getTentatives(): Collection
    {
        return $this->tentatives;
    }

    public function addTentative(Tentative $tentative): static
    {
        if (!$this->tentatives->contains($tentative)) {
            $this->tentatives->add($tentative);
        }

        return $this;
    }

    public function removeTentative(Tentative $tentative): static
    {
        $this->tentatives->removeElement($tentative);

        return $this;
    }

    /**
     * @return Collection<int, Critere>
     */
    public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Critere $critere): static
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres->add($critere);
            $critere->addSolution($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): static
    {
        if ($this->criteres->removeElement($critere)) {
            $critere->removeSolution($this);
        }

        return $this;
    }
}
