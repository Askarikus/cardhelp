<?php

namespace App\Entity;

use App\Repository\GroupClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupClientRepository::class)]
class GroupClient extends AbstractEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'groupClients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\OneToMany(mappedBy: 'groupClient', targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\OneToMany(mappedBy: 'groupClient', targetEntity: CardSettings::class)]
    private Collection $cardSettings;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->cardSettings = new ArrayCollection();
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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->setGroupClient($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getGroupClient() === $this) {
                $client->setGroupClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CardSettings>
     */
    public function getCardSettings(): Collection
    {
        return $this->cardSettings;
    }

    public function addCardSetting(CardSettings $cardSetting): self
    {
        if (!$this->cardSettings->contains($cardSetting)) {
            $this->cardSettings->add($cardSetting);
            $cardSetting->setGroupClient($this);
        }

        return $this;
    }

    public function removeCardSetting(CardSettings $cardSetting): self
    {
        if ($this->cardSettings->removeElement($cardSetting)) {
            // set the owning side to null (unless already changed)
            if ($cardSetting->getGroupClient() === $this) {
                $cardSetting->setGroupClient(null);
            }
        }

        return $this;
    }
}
