<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReclamationRepository;



/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id_utilisateur")
     */
    private $utilisateur;


    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_utilisateur", type="string", length=255, nullable=true)
     */
    private $nomUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom_utilisateur", type="string", length=255, nullable=true)
     */
    private $prenomUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_utilisateur", type="string", length=255, nullable=true)
     */
    private $emailUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_reclamation", type="text", length=65535, nullable=true)
     */
    private $descriptionReclamation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_reclamation", type="string", length=255, nullable=true)
     */
    private $etatReclamation;



    public function getIdReclamation(): ?int
    {
        return $this->idReclamation;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(?string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(?string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->emailUtilisateur;
    }

    public function setEmailUtilisateur(?string $emailUtilisateur): self
    {
        $this->emailUtilisateur = $emailUtilisateur;

        return $this;
    }

    public function getDescriptionReclamation(): ?string
    {
        return $this->descriptionReclamation;
    }

    public function setDescriptionReclamation(?string $descriptionReclamation): self
    {
        $this->descriptionReclamation = $descriptionReclamation;

        return $this;
    }

    public function getEtatReclamation(): ?string
    {
        return $this->etatReclamation;
    }

    public function setEtatReclamation(?string $etatReclamation): self
    {
        $this->etatReclamation = $etatReclamation;

        return $this;
    }

    public function getUtilisateur(): ?int
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }


}
