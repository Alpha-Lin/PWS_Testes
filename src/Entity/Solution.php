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

    #[ORM\ManyToOne(inversedBy: 'solutions')]
    private ?Critere $critere = null;

    #[ORM\Column]
    private ?float $point = null;

    public function __construct()
    {
        $this->tentatives = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->nomSolution;
    }

    public function getCritere(): ?Critere
    {
        return $this->critere;
    }

    public function setCritere(?Critere $critere): static
    {
        $this->critere = $critere;

        return $this;
    }

    public function getPoint(): ?float
    {
        return $this->point;
    }

    public function setPoint(float $point): static
    {
        $this->point = $point;

        return $this;
    }

}
