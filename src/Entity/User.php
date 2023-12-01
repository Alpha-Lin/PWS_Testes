<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Teste::class)]
    private Collection $testes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Tentative::class)]
    private Collection $Tentatives;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->testes = new ArrayCollection();
        $this->Tentatives = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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
            $testis->setUser($this);
        }

        return $this;
    }

    public function removeTestis(Teste $testis): static
    {
        if ($this->testes->removeElement($testis)) {
            // set the owning side to null (unless already changed)
            if ($testis->getUser() === $this) {
                $testis->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tentative>
     */
    public function getTentatives(): Collection
    {
        return $this->Tentatives;
    }

    public function addTentative(Tentative $tentative): static
    {
        if (!$this->Tentatives->contains($tentative)) {
            $this->Tentatives->add($tentative);
            $tentative->setUser($this);
        }

        return $this;
    }

    public function removeTentative(Tentative $tentative): static
    {
        if ($this->Tentatives->removeElement($tentative)) {
            // set the owning side to null (unless already changed)
            if ($tentative->getUser() === $this) {
                $tentative->setUser(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return (string) $this->username;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setSender($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getSender() === $this) {
                $message->setSender(null);
            }
        }

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
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }
}
