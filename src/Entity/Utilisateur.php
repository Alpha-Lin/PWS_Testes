<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mailUtilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $nomUtilisateur = null;

    #[ORM\Column(length: 97)]
    private ?string $motDePasseUtilisateur = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Tentative::class)]
    private Collection $tentatives;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: Teste::class)]
    private Collection $testes;

    #[ORM\Column]
    private ?int $idUtilisateur = null;

    public function __construct()
    {
        $this->tentatives = new ArrayCollection();
        $this->testes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailUtilisateur(): ?string
    {
        return $this->mailUtilisateur;
    }

    public function setMailUtilisateur(string $mailUtilisateur): static
    {
        $this->mailUtilisateur = $mailUtilisateur;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): static
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getMotDePasseUtilisateur(): ?string
    {
        return $this->motDePasseUtilisateur;
    }

    public function setMotDePasseUtilisateur(string $motDePasseUtilisateur): static
    {
        $this->motDePasseUtilisateur = $motDePasseUtilisateur;

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
            $tentative->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTentative(Tentative $tentative): static
    {
        if ($this->tentatives->removeElement($tentative)) {
            // set the owning side to null (unless already changed)
            if ($tentative->getUtilisateur() === $this) {
                $tentative->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Teste>
     */
    public function getTestes(): Collection
    {
        return $this->testes;
    }

    public function addTestis(Teste $testis): static
    {
        if (!$this->testes->contains($testis)) {
            $this->testes->add($testis);
            $testis->setCreateur($this);
        }

        return $this;
    }

    public function removeTestis(Teste $testis): static
    {
        if ($this->testes->removeElement($testis)) {
            // set the owning side to null (unless already changed)
            if ($testis->getCreateur() === $this) {
                $testis->setCreateur(null);
            }
        }

        return $this;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): static
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
