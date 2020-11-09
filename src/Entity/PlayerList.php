<?php

namespace App\Entity;

use App\Repository\PlayerListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerListRepository::class)
 */
class PlayerList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Sport::class, mappedBy="playerList")
     */
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity=Position::class, mappedBy="playerList")
     */
    private $position;

    public function __construct()
    {
        $this->sport = new ArrayCollection();
        $this->position = new ArrayCollection();
    }

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

    /**
     * @return Collection|Sport[]
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sport->contains($sport)) {
            $this->sport[] = $sport;
            $sport->setPlayerList($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sport->contains($sport)) {
            $this->sport->removeElement($sport);
            // set the owning side to null (unless already changed)
            if ($sport->getPlayerList() === $this) {
                $sport->setPlayerList(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getPosition(): Collection
    {
        return $this->position;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->position->contains($position)) {
            $this->position[] = $position;
            $position->setPlayerList($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->position->contains($position)) {
            $this->position->removeElement($position);
            // set the owning side to null (unless already changed)
            if ($position->getPlayerList() === $this) {
                $position->setPlayerList(null);
            }
        }

        return $this;
    }
}
