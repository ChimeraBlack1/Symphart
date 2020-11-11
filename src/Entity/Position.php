<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 */
class Position
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
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="positions")
     */
    private $sport;

    /**
     * @ORM\ManyToOne(targetEntity=PlayerList::class, inversedBy="position")
     */
    private $playerList;

    /**
     * @ORM\OneToMany(targetEntity=ListOfPlayers::class, mappedBy="position")
     */
    private $listOfPlayers;

    public function __construct()
    {
        $this->listOfPlayers = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
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

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

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
            $listOfPlayer->setPosition($this);
        }

        return $this;
    }

    public function removeListOfPlayer(ListOfPlayers $listOfPlayer): self
    {
        if ($this->listOfPlayers->contains($listOfPlayer)) {
            $this->listOfPlayers->removeElement($listOfPlayer);
            // set the owning side to null (unless already changed)
            if ($listOfPlayer->getPosition() === $this) {
                $listOfPlayer->setPosition(null);
            }
        }

        return $this;
    }
}
