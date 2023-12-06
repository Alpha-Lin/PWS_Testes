<?php

namespace App\Entity;

use App\Repository\CritereSolutionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritereSolutionRepository::class)]
class CritereSolution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $point = null;

    #[ORM\ManyToOne(inversedBy: 'critereSolutions', fetch: "EAGER")]
    private ?Tentative $tentative = null;

    #[ORM\ManyToOne(inversedBy: 'critereSolutions', fetch: "EAGER")]
    private ?Critere $critere = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function gete(): ?Tentative
    {
        return $this->tentative;
    }

    public function setTentative(?Tentative $tentative): static
    {
        $this->tentative = $tentative;

        return $this;
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
}
