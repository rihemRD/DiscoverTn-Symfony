<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_location", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_location", type="string", length=255, nullable=false)
     */
    private $nomLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="type_location", type="string", length=255, nullable=false)
     */
    private $typeLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_location", type="string", length=255, nullable=false)
     */
    private $lieuLocation;

    /**
     * @var int
     *
     * @ORM\Column(name="numtel_location", type="integer", nullable=false)
     */
    private $numtelLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_location", type="string", length=255, nullable=false)
     */
    private $heureLocation;

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     */
    private $userid;

    public function getIdLocation(): ?int
    {
        return $this->idLocation;
    }

    public function getNomLocation(): ?string
    {
        return $this->nomLocation;
    }

    public function setNomLocation(string $nomLocation): self
    {
        $this->nomLocation = $nomLocation;

        return $this;
    }

    public function getTypeLocation(): ?string
    {
        return $this->typeLocation;
    }

    public function setTypeLocation(string $typeLocation): self
    {
        $this->typeLocation = $typeLocation;

        return $this;
    }

    public function getLieuLocation(): ?string
    {
        return $this->lieuLocation;
    }

    public function setLieuLocation(string $lieuLocation): self
    {
        $this->lieuLocation = $lieuLocation;

        return $this;
    }

    public function getNumtelLocation(): ?int
    {
        return $this->numtelLocation;
    }

    public function setNumtelLocation(int $numtelLocation): self
    {
        $this->numtelLocation = $numtelLocation;

        return $this;
    }

    public function getHeureLocation(): ?string
    {
        return $this->heureLocation;
    }

    public function setHeureLocation(string $heureLocation): self
    {
        $this->heureLocation = $heureLocation;

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }


}
