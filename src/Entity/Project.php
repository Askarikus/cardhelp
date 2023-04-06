<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(formats: 'json')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project extends AbstractEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Filial::class)]
    private Collection $filials;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: GroupClient::class)]
    private Collection $groupClients;

    public function __construct()
    {
        $this->filials = new ArrayCollection();
        $this->groupClients = new ArrayCollection();
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
            $filial->setProject($this);
        }

        return $this;
    }

    public function removeFilial(Filial $filial): self
    {
        if ($this->filials->removeElement($filial)) {
            // set the owning side to null (unless already changed)
            if ($filial->getProject() === $this) {
                $filial->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupClient>
     */
    public function getGroupClients(): Collection
    {
        return $this->groupClients;
    }

    public function addGroupClient(GroupClient $groupClient): self
    {
        if (!$this->groupClients->contains($groupClient)) {
            $this->groupClients->add($groupClient);
            $groupClient->setProject($this);
        }

        return $this;
    }

    public function removeGroupClient(GroupClient $groupClient): self
    {
        if ($this->groupClients->removeElement($groupClient)) {
            // set the owning side to null (unless already changed)
            if ($groupClient->getProject() === $this) {
                $groupClient->setProject(null);
            }
        }

        return $this;
    }
}
