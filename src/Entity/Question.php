<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Teste $teste = null;

    #[ORM\OneToMany(mappedBy: 'Question', targetEntity: Solution::class)]
    private Collection $solutions;

    public function __construct()
    {
        $this->solutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

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
            $solution->setQuestion($this);
        }

        return $this;
    }

    public function removeSolution(Solution $solution): static
    {
        if ($this->solutions->removeElement($solution)) {
            // set the owning side to null (unless already changed)
            if ($solution->getQuestion() === $this) {
                $solution->setQuestion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->question;
    }
}
