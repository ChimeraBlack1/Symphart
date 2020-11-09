<?php

namespace App\Entity;

use App\Repository\PositionRepository;
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
}
