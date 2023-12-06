<?php

namespace App\Entity;

use App\Repository\TesteRepository;
use App\Entity\TypeTeste;
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

    #[ORM\OneToMany(mappedBy: 'teste',fetch: "EAGER", targetEntity: Tentative::class)]
    private Collection $tentatives;

    #[ORM\OneToMany(mappedBy: 'teste',fetch: "EAGER",targetEntity: Question::class, cascade: ["all"])]
    private Collection $questions;

    #[ORM\OneToMany(mappedBy: 'teste',fetch: "EAGER", targetEntity: Critere::class, cascade: ["all"])]
    private Collection $criteres;

    #[ORM\ManyToOne(inversedBy: 'testes')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'testes')]
    private ?TypeTeste $typeTeste = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageTeste = null;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->tentatives = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->criteres = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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


    public function getTypeTeste(): ?TypeTeste
    {
        return $this->typeTeste;
    }

    public function setTypeTeste(?TypeTeste $typeTeste): static
    {
        $this->typeTeste = $typeTeste;
        return $this;
    }


    public function __toString()
    {
        return (string) $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageTeste(): ?string
    {
        return $this->imageTeste;
    }

    public function setImageTeste(string $imageTeste): static
    {
        $this->imageTeste = $imageTeste;

        return $this;
    }
    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setTest($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getTest() === $this) {
                $commentaire->setTest(null);
            }
        }

        return $this;
    }
}
