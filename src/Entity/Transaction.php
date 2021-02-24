<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRetrait;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateAnnulation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ttc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fraisEtat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fraisSystem;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fraisEnvoie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fraisRetrait;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codeTransaction;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="transactions")
     */
    private $comptes;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="transactions")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="transactions")
     */
    private $clients;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(?\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(?\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getDateAnnulation(): ?\DateTimeInterface
    {
        return $this->dateAnnulation;
    }

    public function setDateAnnulation(?\DateTimeInterface $dateAnnulation): self
    {
        $this->dateAnnulation = $dateAnnulation;

        return $this;
    }

    public function getTtc(): ?int
    {
        return $this->ttc;
    }

    public function setTtc(?int $ttc): self
    {
        $this->ttc = $ttc;

        return $this;
    }

    public function getFraisEtat(): ?int
    {
        return $this->fraisEtat;
    }

    public function setFraisEtat(?int $fraisEtat): self
    {
        $this->fraisEtat = $fraisEtat;

        return $this;
    }

    public function getFraisSystem(): ?int
    {
        return $this->fraisSystem;
    }

    public function setFraisSystem(?int $fraisSystem): self
    {
        $this->fraisSystem = $fraisSystem;

        return $this;
    }

    public function getFraisEnvoie(): ?int
    {
        return $this->fraisEnvoie;
    }

    public function setFraisEnvoie(?int $fraisEnvoie): self
    {
        $this->fraisEnvoie = $fraisEnvoie;

        return $this;
    }

    public function getFraisRetrait(): ?int
    {
        return $this->fraisRetrait;
    }

    public function setFraisRetrait(?int $fraisRetrait): self
    {
        $this->fraisRetrait = $fraisRetrait;

        return $this;
    }

    public function getCodeTransaction(): ?int
    {
        return $this->codeTransaction;
    }

    public function setCodeTransaction(?int $codeTransaction): self
    {
        $this->codeTransaction = $codeTransaction;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setTransactions($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getTransactions() === $this) {
                $compte->setTransactions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setTransactions($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTransactions() === $this) {
                $user->setTransactions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setTransactions($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getTransactions() === $this) {
                $client->setTransactions(null);
            }
        }

        return $this;
    }
}
