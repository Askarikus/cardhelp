<?php

namespace App\Entity;

use App\Repository\CardSettingsRepository;
use App\Enum\CardTypesEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\Annotation\Enum;

#[ORM\Entity(repositoryClass: CardSettingsRepository::class)]
class CardSettings extends AbstractEntity
{
    #[ORM\Column(name:'name', length: 255)]
    private ?string $name = null;

    #[ORM\Column(name:'type')]
    private string $type = CardTypesEnum::DISCOUNT;

    #[ORM\Column(nullable: true)]
    private ?int $step = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cardSettings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project_id = null;

    #[ORM\OneToMany(mappedBy: 'settings_id', targetEntity: Card::class)]
    private Collection $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
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

    public function getType(): CardTypesEnum
    {
        return CardTypesEnum::from($this->type);
    }

    public function setType(CardTypesEnum $type): void
    {
        $this->type = $type->value;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(?int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProjectId(): ?Project
    {
        return $this->project_id;
    }

    public function setProjectId(?Project $project_id): self
    {
        $this->project_id = $project_id;

        return $this;
    }

    /**
     * @return Collection<int, Card>
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Card $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
            $card->setSettingsId($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->cards->removeElement($card)) {
            // set the owning side to null (unless already changed)
            if ($card->getSettingsId() === $this) {
                $card->setSettingsId(null);
            }
        }

        return $this;
    }
}
