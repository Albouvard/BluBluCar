<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItineraireRepository")
 */
class Itineraire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voyage", inversedBy="itineraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idVoyage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="itineraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="itineraires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idArrive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVoyage(): ?Voyage
    {
        return $this->idVoyage;
    }

    public function setIdVoyage(?Voyage $idVoyage): self
    {
        $this->idVoyage = $idVoyage;

        return $this;
    }

    public function getIdDepart(): ?Ville
    {
        return $this->idDepart;
    }

    public function setIdDepart(?Ville $idDepart): self
    {
        $this->idDepart = $idDepart;

        return $this;
    }

    public function getIdArrive(): ?Ville
    {
        return $this->idArrive;
    }

    public function setIdArrive(?Ville $idArrive): self
    {
        $this->idArrive = $idArrive;

        return $this;
    }
}
