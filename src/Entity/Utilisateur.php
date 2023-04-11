<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_utilisateur", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "Your first name must be at least  4  characters long",
     * )
     */
    private $nomUtilisateur;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Le prenom est obligatoire")
     * @Assert\Length(
     *      min = 4,
     *      max = 50,
     *      minMessage = "Your first name must be at least  4  characters long",
     *      maxMessage = "Your first name cannot be longer than 50 characters"
     * )
     * @ORM\Column(name="prenom_utilisateur", type="string", length=255, nullable=true)
     */
    private $prenomUtilisateur;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Email est obligatoire")
     * @ORM\Column(name="email_utilisateur", type="string", length=255, nullable=true)
     */
    private $emailUtilisateur;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Email est obligatoire")
     * @Assert\Length(6)
     * @ORM\Column(name="login_utilisateur", type="string", length=255, nullable=true)
     */
    private $loginUtilisateur;

    /**
     * @var string|null
     * @Assert\NotBlank(message="MDP est obligatoire")
     * @ORM\Column(name="mdp_utilisateur", type="string", length=255, nullable=true)
     * @Assert\Length(6)
     */
    private $mdpUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_utilisateur", type="string", length=255, nullable=true)
     *       @Assert\NotBlank(message="MDP est obligatoire")

     */
    private $imageUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank_utilisateur", type="string", length=255, nullable=true)
     *       @Assert\NotBlank(message="MDP est obligatoire")

     */
    private $rankUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone_utilisateur", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="telephone est obligatoire")
     *  @Assert\Regex(
     *     pattern="/^\d+$/",
     *     message="The value should contain only digits."
     * )
     */
    private $telephoneUtilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_utilisateur", type="string", length=255, nullable=true)
     *       @Assert\NotBlank(message="MDP est obligatoire")
     */
    private $adresseUtilisateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reclamation", mappedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $reclamation;

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }
    /**
     * @param int $idUtilisateur
     */
    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
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

    public function getLoginUtilisateur(): ?string
    {
        return $this->loginUtilisateur;
    }

    public function setLoginUtilisateur(?string $loginUtilisateur): self
    {
        $this->loginUtilisateur = $loginUtilisateur;

        return $this;
    }

    public function getMdpUtilisateur(): ?string
    {
        return $this->mdpUtilisateur;
    }

    public function setMdpUtilisateur(?string $mdpUtilisateur): self
    {
        $this->mdpUtilisateur = $mdpUtilisateur;

        return $this;
    }

    public function getImageUtilisateur(): ?string
    {
        return $this->imageUtilisateur;
    }

    public function setImageUtilisateur(?string $imageUtilisateur): self
    {
        $this->imageUtilisateur = $imageUtilisateur;

        return $this;
    }

    public function getRankUtilisateur(): ?string
    {
        return $this->rankUtilisateur;
    }

    public function setRankUtilisateur(?string $rankUtilisateur): self
    {
        $this->rankUtilisateur = $rankUtilisateur;

        return $this;
    }

    public function getTelephoneUtilisateur(): ?string
    {
        return $this->telephoneUtilisateur;
    }

    public function setTelephoneUtilisateur(?string $telephoneUtilisateur): self
    {
        $this->telephoneUtilisateur = $telephoneUtilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?string
    {
        return $this->adresseUtilisateur;
    }

    public function setAdresseUtilisateur(?string $adresseUtilisateur): self
    {
        $this->adresseUtilisateur = $adresseUtilisateur;

        return $this;
    }


}
