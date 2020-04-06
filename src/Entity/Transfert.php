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
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="transfertsDebit")
     * @ORM\JoinColumn(onDelete="SET NULL") 
     */
    private $accountToDebit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="transfertsCredit")
     * @ORM\JoinColumn(onDelete="SET NULL") 
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

    public function getAccountToDebit(): ?Account
    {
        return $this->accountToDebit;
    }

    public function setAccountToDebit(?Account $accountToDebit): self
    {
        $this->accountToDebit = $accountToDebit;

        return $this;
    }

    public function getAccountToCredit(): ?Account
    {
        return $this->accountToCredit;
    }

    public function setAccountToCredit(?Account $accountToCredit): self
    {
        $this->accountToCredit = $accountToCredit;

        return $this;
    }

}
