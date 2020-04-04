<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransfertRepository")
 */
class Transfert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer")
     */
    private $accountToDebit;

    /**
     * @ORM\Column(type="integer")
     */
    private $accountToCredit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getAccountToDebit(): ?int
    {
        return $this->accountToDebit;
    }

    public function setAccountToDebit(int $accountToDebit): self
    {
        $this->accountToDebit = $accountToDebit;

        return $this;
    }

    public function getAccountToCredit(): ?int
    {
        return $this->accountToCredit;
    }

    public function setAccountToCredit(int $accountToCredit): self
    {
        $this->accountToCredit = $accountToCredit;

        return $this;
    }
}
