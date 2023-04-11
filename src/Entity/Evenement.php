<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_event", type="string", length=50, nullable=false)
     */
    private $titreEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_event", type="datetime", nullable=false)
     */
    private $dateDebutEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_event", type="datetime", nullable=false)
     */
    private $dateFinEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_event", type="string", length=50, nullable=false)
     */
    private $prixEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_event", type="string", length=50, nullable=false)
     */
    private $lieuEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_event", type="text", length=65535, nullable=false)
     */
    private $descEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="image_event", type="string", length=100, nullable=false)
     */
    private $imageEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="id_evenement_type", type="integer", nullable=false)
     */
    private $idEvenementType;

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getTitreEvent(): ?string
    {
        return $this->titreEvent;
    }

    public function setTitreEvent(string $titreEvent): self
    {
        $this->titreEvent = $titreEvent;

        return $this;
    }

    public function getDateDebutEvent(): ?\DateTimeInterface
    {
        return $this->dateDebutEvent;
    }

    public function setDateDebutEvent(\DateTimeInterface $dateDebutEvent): self
    {
        $this->dateDebutEvent = $dateDebutEvent;

        return $this;
    }

    public function getDateFinEvent(): ?\DateTimeInterface
    {
        return $this->dateFinEvent;
    }

    public function setDateFinEvent(\DateTimeInterface $dateFinEvent): self
    {
        $this->dateFinEvent = $dateFinEvent;

        return $this;
    }

    public function getPrixEvent(): ?string
    {
        return $this->prixEvent;
    }

    public function setPrixEvent(string $prixEvent): self
    {
        $this->prixEvent = $prixEvent;

        return $this;
    }

    public function getLieuEvent(): ?string
    {
        return $this->lieuEvent;
    }

    public function setLieuEvent(string $lieuEvent): self
    {
        $this->lieuEvent = $lieuEvent;

        return $this;
    }

    public function getDescEvent(): ?string
    {
        return $this->descEvent;
    }

    public function setDescEvent(string $descEvent): self
    {
        $this->descEvent = $descEvent;

        return $this;
    }

    public function getImageEvent(): ?string
    {
        return $this->imageEvent;
    }

    public function setImageEvent(string $imageEvent): self
    {
        $this->imageEvent = $imageEvent;

        return $this;
    }

    public function getIdEvenementType(): ?int
    {
        return $this->idEvenementType;
    }

    public function setIdEvenementType(int $idEvenementType): self
    {
        $this->idEvenementType = $idEvenementType;

        return $this;
    }


}
