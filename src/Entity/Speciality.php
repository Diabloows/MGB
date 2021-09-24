<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialityRepository::class)
 */
class Speciality
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
    private $CodeSpe;

    /**
     * @ORM\Column(type="text")
     */
    private $Nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeSpe(): ?int
    {
        return $this->CodeSpe;
    }

    public function setCodeSpe(int $CodeSpe): self
    {
        $this->CodeSpe = $CodeSpe;

        return $this;
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
}
