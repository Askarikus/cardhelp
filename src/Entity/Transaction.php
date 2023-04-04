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
    private ?Card $card_id = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filial $filial_id = null;

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
        return $this->card_id;
    }

    public function setCardId(?Card $card_id): self
    {
        $this->card_id = $card_id;

        return $this;
    }

    public function getFilialId(): ?Filial
    {
        return $this->filial_id;
    }

    public function setFilialId(?Filial $filial_id): self
    {
        $this->filial_id = $filial_id;

        return $this;
    }
}
