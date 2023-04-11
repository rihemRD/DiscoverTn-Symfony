<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RandonneeRepository;

#[ORM\Entity(repositoryClass: RandonneeRepository::class)]
class Randonnee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idRandonnee;

    #[ORM\Column(length:1000)]
    private ?string $nom;

    #[ORM\Column]
    private ?\DateTime $dateRand;

    #[ORM\Column(length:1000)]
    private ?string $lieux;

    #[ORM\Column]
    private ?float $prix;

    #[ORM\Column(length:50)]
    private ?string $niveauDiff;

    #[ORM\Column(type: Types::TEXT)]
    private ?string$programme;

    #[ORM\Column(length:255)]
    private ?string $imagesr;

    #[ORM\Column]
    private ?int $nbrPlacer;

    public function getIdRandonnee(): ?int
    {
        return $this->idRandonnee;
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

    public function getDateRand(): ?\DateTimeInterface
    {
        return $this->dateRand;
    }

    public function setDateRand(\DateTimeInterface $dateRand): self
    {
        $this->dateRand = $dateRand;

        return $this;
    }

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNiveauDiff(): ?string
    {
        return $this->niveauDiff;
    }

    public function setNiveauDiff(string $niveauDiff): self
    {
        $this->niveauDiff = $niveauDiff;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getImagesr(): ?string
    {
        return $this->imagesr;
    }

    public function setImagesr(string $imagesr): self
    {
        $this->imagesr = $imagesr;

        return $this;
    }

    public function getNbrPlacer(): ?int
    {
        return $this->nbrPlacer;
    }

    public function setNbrPlacer(int $nbrPlacer): self
    {
        $this->nbrPlacer = $nbrPlacer;

        return $this;
    }


}
