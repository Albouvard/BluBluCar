<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoyageUsagerRepository")
 */
class VoyageUsager
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voyage", inversedBy="voyageUsagers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idVoyage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usager", inversedBy="voyageUsagers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUsager;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbReservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVoyage(): int
    {
        return $this->idVoyage;
    }

    public function setIdVoyage(?int $idVoyage): self
    {
        $this->idVoyage = $idVoyage;

        return $this;
    }

    public function getIdUsager(): ?Usager
    {
        return $this->idUsager;
    }

    public function setIdUsager(?Usager $idUsager): self
    {
        $this->idUsager = $idUsager;

        return $this;
    }

    public function getNbReservation(): ?int
    {
        return $this->nbReservation;
    }

    public function setNbReservation(int $nbReservation): self
    {
        $this->nbReservation = $nbReservation;

        return $this;
    }
}
