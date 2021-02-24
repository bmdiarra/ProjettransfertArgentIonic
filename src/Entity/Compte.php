<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 */
class Compte
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
    private $numCompte;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="comptes")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Transaction::class, inversedBy="comptes")
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity=Depot::class, mappedBy="comptes")
     */
    private $depots;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->depots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompte(): ?int
    {
        return $this->numCompte;
    }

    public function setNumCompte(int $numCompte): self
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(?int $solde): self
    {
        $this->solde = $solde;

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
            $user->setComptes($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getComptes() === $this) {
                $user->setComptes(null);
            }
        }

        return $this;
    }

    public function getTransactions(): ?Transaction
    {
        return $this->transactions;
    }

    public function setTransactions(?Transaction $transactions): self
    {
        $this->transactions = $transactions;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setComptes($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->removeElement($depot)) {
            // set the owning side to null (unless already changed)
            if ($depot->getComptes() === $this) {
                $depot->setComptes(null);
            }
        }

        return $this;
    }
}
