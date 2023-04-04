<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project extends AbstractEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\OneToMany(mappedBy: 'project_id', targetEntity: CardSettings::class)]
    private Collection $cardSettings;

    #[ORM\OneToMany(mappedBy: 'project_id', targetEntity: Filial::class)]
    private Collection $filials;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->cardSettings = new ArrayCollection();
        $this->filials = new ArrayCollection();
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
            $client->setProject($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getProject() === $this) {
                $client->setProject(null);
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
            $cardSetting->setProjectId($this);
        }

        return $this;
    }

    public function removeCardSetting(CardSettings $cardSetting): self
    {
        if ($this->cardSettings->removeElement($cardSetting)) {
            // set the owning side to null (unless already changed)
            if ($cardSetting->getProjectId() === $this) {
                $cardSetting->setProjectId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Filial>
     */
    public function getFilials(): Collection
    {
        return $this->filials;
    }

    public function addFilial(Filial $filial): self
    {
        if (!$this->filials->contains($filial)) {
            $this->filials->add($filial);
            $filial->setProjectId($this);
        }

        return $this;
    }

    public function removeFilial(Filial $filial): self
    {
        if ($this->filials->removeElement($filial)) {
            // set the owning side to null (unless already changed)
            if ($filial->getProjectId() === $this) {
                $filial->setProjectId(null);
            }
        }

        return $this;
    }
}
