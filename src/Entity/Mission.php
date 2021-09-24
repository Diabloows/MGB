<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Titre;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="text")
     */
    private $Nom_de_code;

    /**
     * @ORM\Column(type="text")
     */
    private $Pays;

    /**
     * @ORM\Column(type="text")
     */
    private $Agent;

    /**
     * @ORM\Column(type="text")
     */
    private $Contact;

    /**
     * @ORM\Column(type="text")
     */
    private $Cible;

    /**
     * @ORM\Column(type="text")
     */
    private $Type_Mission;

    /**
     * @ORM\Column(type="text")
     */
    private $Statut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Planque;

    /**
     * @ORM\Column(type="text")
     */
    private $Specialite;

    /**
     * @ORM\Column(type="date")
     */
    private $Debut;

    /**
     * @ORM\Column(type="date")
     */
    private $Fin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNomDeCode(): ?string
    {
        return $this->Nom_de_code;
    }

    public function setNomDeCode(string $Nom_de_code): self
    {
        $this->Nom_de_code = $Nom_de_code;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getAgent(): ?string
    {
        return $this->Agent;
    }

    public function setAgent(string $Agent): self
    {
        $this->Agent = $Agent;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->Contact;
    }

    public function setContact(string $Contact): self
    {
        $this->Contact = $Contact;

        return $this;
    }

    public function getCible(): ?string
    {
        return $this->Cible;
    }

    public function setCible(string $Cible): self
    {
        $this->Cible = $Cible;

        return $this;
    }

    public function getTypeMission(): ?string
    {
        return $this->Type_Mission;
    }

    public function setTypeMission(string $Type_Mission): self
    {
        $this->Type_Mission = $Type_Mission;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getPlanque(): ?string
    {
        return $this->Planque;
    }

    public function setPlanque(?string $Planque): self
    {
        $this->Planque = $Planque;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->Specialite;
    }

    public function setSpecialite(string $Specialite): self
    {
        $this->Specialite = $Specialite;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->Debut;
    }

    public function setDebut(\DateTimeInterface $Debut): self
    {
        $this->Debut = $Debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->Fin;
    }

    public function setFin(\DateTimeInterface $Fin): self
    {
        $this->Fin = $Fin;

        return $this;
    }
}
