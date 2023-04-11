<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Randonnee
 *
 * @ORM\Table(name="randonnee")
 * @ORM\Entity
 */
class Randonnee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Randonnee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRandonnee;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=1000, nullable=false)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Rand", type="date", nullable=false)
     */
    private $dateRand;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieux", type="string", length=1000, nullable=false)
     */
    private $lieux;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveau_diff", type="string", length=50, nullable=false)
     */
    private $niveauDiff;

    /**
     * @var string
     *
     * @ORM\Column(name="Programme", type="text", length=0, nullable=false)
     */
    private $programme;

    /**
     * @var string
     *
     * @ORM\Column(name="ImagesR", type="string", length=255, nullable=false)
     */
    private $imagesr;

    /**
     * @var int
     *
     * @ORM\Column(name="Nbr_PlaceR", type="integer", nullable=false)
     */
    private $nbrPlacer;

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
