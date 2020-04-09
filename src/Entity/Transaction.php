<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @var int
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var float
     * 
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @var Account
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $account;

    /**
     * @var DateTimeInterface|null
     * 
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    public function getId(): ?int
    {
        return $this->id; 
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

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
}
