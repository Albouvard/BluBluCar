<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Itineraire", mappedBy="idDepart")
     */
    private $itineraires;

    public function __construct()
    {
        $this->itineraires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
            $itineraire->setIdDepart($this);
        }

        return $this;
    }

    public function removeItineraire(Itineraire $itineraire): self
    {
        if ($this->itineraires->contains($itineraire)) {
            $this->itineraires->removeElement($itineraire);
            // set the owning side to null (unless already changed)
            if ($itineraire->getIdDepart() === $this) {
                $itineraire->setIdDepart(null);
            }
        }

        return $this;
    }
}
