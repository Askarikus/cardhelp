<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction extends AbstractEntity
{
    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Card $card = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filial $filial = null;

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCardId(): ?Card
    {
        return $this->card;
    }

    public function setCardId(?Card $card): self
    {
        $this->card = $card;

        return $this;
    }

    public function getFilialId(): ?Filial
    {
        return $this->filial;
    }

    public function setFilialId(?Filial $filial): self
    {
        $this->filial = $filial;

        return $this;
    }
}
