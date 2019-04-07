<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoyageRepository")
 */
class Voyage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $horaire_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usager", inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idConducteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoyageUsager", mappedBy="idVoyage")
     */
    private $voyageUsagers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Itineraire", mappedBy="idVoyage")
     */
    private $itineraires;

    public function __construct()
    {
        $this->voyageUsagers = new ArrayCollection();
        $this->itineraires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraireAt(): ?\DateTimeInterface
    {
        return $this->horaire_at;
    }

    public function setHoraireAt(\DateTimeInterface $horaire_at): self
    {
        $this->horaire_at = $horaire_at;

        return $this;
    }

    public function getIdConducteur(): ?Usager
    {
        return $this->idConducteur;
    }

    public function setIdConducteur(?Usager $idConducteur): self
    {
        $this->idConducteur = $idConducteur;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * @return Collection|VoyageUsager[]
     */
    public function getVoyageUsagers(): Collection
    {
        return $this->voyageUsagers;
    }

    public function addVoyageUsager(VoyageUsager $voyageUsager): self
    {
        if (!$this->voyageUsagers->contains($voyageUsager)) {
            $this->voyageUsagers[] = $voyageUsager;
            $voyageUsager->setIdVoyage($this);
        }

        return $this;
    }

    public function removeVoyageUsager(VoyageUsager $voyageUsager): self
    {
        if ($this->voyageUsagers->contains($voyageUsager)) {
            $this->voyageUsagers->removeElement($voyageUsager);
            // set the owning side to null (unless already changed)
            if ($voyageUsager->getIdVoyage() === $this) {
                $voyageUsager->setIdVoyage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Itineraire[]
     */
    public function getItineraires(): Collection
    {
        return $this->itineraires;
    }

    public function addItineraire(Itineraire $itineraire): self
    {
        if (!$this->itineraires->contains($itineraire)) {
            $this->itineraires[] = $itineraire;
            $itineraire->setIdVoyage($this);
        }

        return $this;
    }

    public function removeItineraire(Itineraire $itineraire): self
    {
        if ($this->itineraires->contains($itineraire)) {
            $this->itineraires->removeElement($itineraire);
            // set the owning side to null (unless already changed)
            if ($itineraire->getIdVoyage() === $this) {
                $itineraire->setIdVoyage(null);
            }
        }

        return $this;
    }
}
