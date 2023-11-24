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
    #[ORM\JoinColumn(nullable: false)]
    private ?Teste $teste = null;

    #[ORM\ManyToMany(targetEntity: Solution::class, mappedBy: 'tentatives')]
    private Collection $solutions;

    #[ORM\ManyToOne(inversedBy: 'Tentatives')]
    private ?User $user = null;

    public function __construct()
    {
        $this->solutions = new ArrayCollection();
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
            $solution->addTentative($this);
        }

        return $this;
    }

    public function removeSolution(Solution $solution): static
    {
        if ($this->solutions->removeElement($solution)) {
            $solution->removeTentative($this);
        }

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
}
