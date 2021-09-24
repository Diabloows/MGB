<?php

namespace App\Entity;

use App\Repository\PlanqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanqueRepository::class)
 */
class Planque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CodePlanque;

    /**
     * @ORM\Column(type="text")
     */
    private $Adresse;

    /**
     * @ORM\Column(type="text")
     */
    private $Pays;

    /**
     * @ORM\Column(type="text")
     */
    private $Type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePlanque(): ?int
    {
        return $this->CodePlanque;
    }

    public function setCodePlanque(int $CodePlanque): self
    {
        $this->CodePlanque = $CodePlanque;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

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

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
