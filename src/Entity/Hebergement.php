<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hebergement
 *
 * @ORM\Table(name="hebergement")
 * @ORM\Entity
 */
class Hebergement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_heber", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHeber;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_heber", type="string", length=255, nullable=false)
     */
    private $nomHeber;

    /**
     * @var string
     *
     * @ORM\Column(name="description_heber", type="string", length=500, nullable=false)
     */
    private $descriptionHeber;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_chambre", type="integer", nullable=false)
     */
    private $nbChambre;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_heber", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixHeber;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation_heber", type="string", length=255, nullable=false)
     */
    private $localisationHeber;

    /**
     * @var int
     *
     * @ORM\Column(name="contact_heber", type="integer", nullable=false)
     */
    private $contactHeber;

    /**
     * @var string
     *
     * @ORM\Column(name="type_heber", type="string", length=255, nullable=false)
     */
    private $typeHeber;

    public function getIdHeber(): ?int
    {
        return $this->idHeber;
    }

    public function getNomHeber(): ?string
    {
        return $this->nomHeber;
    }

    public function setNomHeber(string $nomHeber): self
    {
        $this->nomHeber = $nomHeber;

        return $this;
    }

    public function getDescriptionHeber(): ?string
    {
        return $this->descriptionHeber;
    }

    public function setDescriptionHeber(string $descriptionHeber): self
    {
        $this->descriptionHeber = $descriptionHeber;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nbChambre;
    }

    public function setNbChambre(int $nbChambre): self
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    public function getPrixHeber(): ?float
    {
        return $this->prixHeber;
    }

    public function setPrixHeber(float $prixHeber): self
    {
        $this->prixHeber = $prixHeber;

        return $this;
    }

    public function getLocalisationHeber(): ?string
    {
        return $this->localisationHeber;
    }

    public function setLocalisationHeber(string $localisationHeber): self
    {
        $this->localisationHeber = $localisationHeber;

        return $this;
    }

    public function getContactHeber(): ?int
    {
        return $this->contactHeber;
    }

    public function setContactHeber(int $contactHeber): self
    {
        $this->contactHeber = $contactHeber;

        return $this;
    }

    public function getTypeHeber(): ?string
    {
        return $this->typeHeber;
    }

    public function setTypeHeber(string $typeHeber): self
    {
        $this->typeHeber = $typeHeber;

        return $this;
    }


}
