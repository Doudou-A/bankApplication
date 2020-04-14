<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Transfert;
use App\Entity\Transaction;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
     * @var integer
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer
     * 
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @var float
     * 
     * @ORM\Column(type="float")
     */
    private $money;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="accounts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="account")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $transactions;

    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Transfert", mappedBy="accountToDebit")
     */
    private $transfertsDebit;

    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Transfert", mappedBy="accountToCredit")
     */
    private $transfertsCredit;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->transfertsDebit = new ArrayCollection();
        $this->transfertsCredit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }

    public function setMoney(float $money): self
    {
        $this->money = $money;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return ArrayCollection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setAccount($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getAccount() === $this) {
                $transaction->setAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transfert[]
     */
    public function getTransfertsDebit(): Collection
    {
        return $this->transfertsDebit;
    }

    public function addTransfertsDebit(Transfert $transfertsDebit): self
    {
        if (!$this->transfertsDebit->contains($transfertsDebit)) {
            $this->transfertsDebit[] = $transfertsDebit;
            $transfertsDebit->setAccountToDebit($this);
        }

        return $this;
    }

    public function removeTransfertsDebit(Transfert $transfertsDebit): self
    {
        if ($this->transfertsDebit->contains($transfertsDebit)) {
            $this->transfertsDebit->removeElement($transfertsDebit);
            // set the owning side to null (unless already changed)
            if ($transfertsDebit->getAccountToDebit() === $this) {
                $transfertsDebit->setAccountToDebit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transfert[]
     */
    public function getTransfertsCredit(): Collection
    {
        return $this->transfertsCredit;
    }

    public function addTransfertsCredit(Transfert $transfertsCredit): self
    {
        if (!$this->transfertsCredit->contains($transfertsCredit)) {
            $this->transfertsCredit[] = $transfertsCredit;
            $transfertsCredit->setAccountToCredit($this);
        }

        return $this;
    }

    public function removeTransfertsCredit(Transfert $transfertsCredit): self
    {
        if ($this->transfertsCredit->contains($transfertsCredit)) {
            $this->transfertsCredit->removeElement($transfertsCredit);
            // set the owning side to null (unless already changed)
            if ($transfertsCredit->getAccountToCredit() === $this) {
                $transfertsCredit->setAccountToCredit(null);
            }
        }

        return $this;
    }
}
