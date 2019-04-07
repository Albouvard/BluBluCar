<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsagerRepository")
 */
class Usager
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ddn_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motdepasse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voyage", mappedBy="idConducteur")
     */
    private $voyages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoyageUsager", mappedBy="idUsager")
     */
    private $voyageUsagers;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
        $this->voyageUsagers = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDdnAt(): ?\DateTimeInterface
    {
        return $this->ddn_at;
    }

    public function setDdnAt(\DateTimeInterface $ddn_at): self
    {
        $this->ddn_at = $ddn_at;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages[] = $voyage;
            $voyage->setIdConducteur($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->contains($voyage)) {
            $this->voyages->removeElement($voyage);
            // set the owning side to null (unless already changed)
            if ($voyage->getIdConducteur() === $this) {
                $voyage->setIdConducteur(null);
            }
        }

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
            $voyageUsager->setIdUsager($this);
        }

        return $this;
    }

    public function removeVoyageUsager(VoyageUsager $voyageUsager): self
    {
        if ($this->voyageUsagers->contains($voyageUsager)) {
            $this->voyageUsagers->removeElement($voyageUsager);
            // set the owning side to null (unless already changed)
            if ($voyageUsager->getIdUsager() === $this) {
                $voyageUsager->setIdUsager(null);
            }
        }

        return $this;
    }
}
