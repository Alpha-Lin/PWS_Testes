<?php

namespace App\Entity;

use App\Repository\TesteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TesteRepository::class)]
class Teste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idTeste = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $imageTeste = null;

    #[ORM\OneToMany(mappedBy: 'teste', targetEntity: Tentative::class)]
    private Collection $tentatives;

    #[ORM\OneToMany(mappedBy: 'teste', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\OneToMany(mappedBy: 'teste', targetEntity: Critere::class)]
    private Collection $criteres;

    #[ORM\ManyToOne(inversedBy: 'testes')]
    private ?User $user = null;

    public function __construct()
    {
        $this->tentatives = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->criteres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTeste(): ?int
    {
        return $this->idTeste;
    }

    public function setIdTeste(int $idTeste): static
    {
        $this->idTeste = $idTeste;

        return $this;
    }

    public function getImageTeste()
    {
        return $this->imageTeste;
    }

    public function setImageTeste($imageTeste): static
    {
        $this->imageTeste = $imageTeste;

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
            $tentative->setTeste($this);
        }

        return $this;
    }

    public function removeTentative(Tentative $tentative): static
    {
        if ($this->tentatives->removeElement($tentative)) {
            // set the owning side to null (unless already changed)
            if ($tentative->getTeste() === $this) {
                $tentative->setTeste(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setTeste($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getTeste() === $this) {
                $question->setTeste(null);
            }
        }

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
            $critere->setTeste($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): static
    {
        if ($this->criteres->removeElement($critere)) {
            // set the owning side to null (unless already changed)
            if ($critere->getTeste() === $this) {
                $critere->setTeste(null);
            }
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
