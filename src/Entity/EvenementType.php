<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvenementType
 *
 * @ORM\Table(name="evenement_type")
 * @ORM\Entity
 */
class EvenementType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_evenement_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenementType;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_evenement_type", type="string", length=30, nullable=false)
     */
    private $nomEvenementType;

    public function getIdEvenementType(): ?int
    {
        return $this->idEvenementType;
    }

    public function getNomEvenementType(): ?string
    {
        return $this->nomEvenementType;
    }

    public function setNomEvenementType(string $nomEvenementType): self
    {
        $this->nomEvenementType = $nomEvenementType;

        return $this;
    }


}
