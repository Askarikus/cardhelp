<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card extends AbstractEntity
{
    #[ORM\ManyToOne(inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client_id = null;

    #[ORM\ManyToOne(inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CardSettings $settings_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $amount = null;

    #[ORM\OneToMany(mappedBy: 'card_id', targetEntity: Transaction::class)]
    private Collection $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }


    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(?Client $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getSettingsId(): ?CardSettings
    {
        return $this->settings_id;
    }

    public function setSettingsId(?CardSettings $settings_id): self
    {
        $this->settings_id = $settings_id;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setCardId($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getCardId() === $this) {
                $transaction->setCardId(null);
            }
        }

        return $this;
    }
}
