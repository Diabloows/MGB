<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
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
    private $Nom;

    /**
     * @ORM\Column(type="text")
     */
    private $Prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $DatedeNaissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $CodeAgent;

    /**
     * @ORM\Column(type="text")
     */
    private $Nationalite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDatedeNaissance(): ?\DateTimeInterface
    {
        return $this->DatedeNaissance;
    }

    public function setDatedeNaissance(\DateTimeInterface $DatedeNaissance): self
    {
        $this->DatedeNaissance = $DatedeNaissance;

        return $this;
    }

    public function getCodeAgent(): ?int
    {
        return $this->CodeAgent;
    }

    public function setCodeAgent(int $CodeAgent): self
    {
        $this->CodeAgent = $CodeAgent;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->Nationalite;
    }

    public function setNationalite(string $Nationalite): self
    {
        $this->Nationalite = $Nationalite;

        return $this;
    }
}
