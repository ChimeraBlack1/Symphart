<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportRepository::class)
 */
class Sport
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
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity=Position::class, mappedBy="sport")
     */
    private $positions;

    /**
     * @ORM\ManyToOne(targetEntity=PlayerList::class, inversedBy="sport")
     */
    private $playerList;

    /**
     * @ORM\OneToMany(targetEntity=ListOfPlayers::class, mappedBy="sport", orphanRemoval=true)
     */
    private $listOfPlayers;
    
    public function __toString() {
        return $this->sport;
    }

    public function __construct()
    {
        $this->positions = new ArrayCollection();
        $this->listOfPlayers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(string $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getPositions(): Collection
    {
        return $this->positions;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->positions->contains($position)) {
            $this->positions[] = $position;
            $position->setSport($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->positions->contains($position)) {
            $this->positions->removeElement($position);
            // set the owning side to null (unless already changed)
            if ($position->getSport() === $this) {
                $position->setSport(null);
            }
        }

        return $this;
    }

    public function getPlayerList(): ?PlayerList
    {
        return $this->playerList;
    }

    public function setPlayerList(?PlayerList $playerList): self
    {
        $this->playerList = $playerList;

        return $this;
    }

    /**
     * @return Collection|ListOfPlayers[]
     */
    public function getListOfPlayers(): Collection
    {
        return $this->listOfPlayers;
    }

    public function addListOfPlayer(ListOfPlayers $listOfPlayer): self
    {
        if (!$this->listOfPlayers->contains($listOfPlayer)) {
            $this->listOfPlayers[] = $listOfPlayer;
            $listOfPlayer->setSport($this);
        }

        return $this;
    }

    public function removeListOfPlayer(ListOfPlayers $listOfPlayer): self
    {
        if ($this->listOfPlayers->contains($listOfPlayer)) {
            $this->listOfPlayers->removeElement($listOfPlayer);
            // set the owning side to null (unless already changed)
            if ($listOfPlayer->getSport() === $this) {
                $listOfPlayer->setSport(null);
            }
        }

        return $this;
    }
}
