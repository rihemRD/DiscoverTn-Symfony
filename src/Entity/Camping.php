<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CampingRepository;
use Datetime;

#[ORM\Entity(repositoryClass: CampingRepository::class)]

class Camping
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idCamping = null;

   
    #[ORM\Column(length:1000)]
    private ?string $nom = null;

   
    #[ORM\Column]
    private ?\DateTime $dateDebut = null;

  
    #[ORM\Column]
    private ?\DateTime $dateFin = null;

   
    #[ORM\Column]
    private ?int $periode = null;

    
    #[ORM\Column]
    private ?float $prix = null;

   
    #[ORM\Column(length:100)]
    private ?string $lieux = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    
    #[ORM\Column(length:255)]
    private $imagec = 'NULL';

   
    #[ORM\Column]
    private ?int $nbr_place = null;

    
    #[ORM\Column]
    private $image = 'NULL';

    public function getIdCamping(): ?int
    {
        return $this->idCamping;
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

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPeriode(): ?int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode): self
    {
        $this->periode = $periode;

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

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImagec(): ?string
    {
        return $this->imagec;
    }

    public function setImagec(?string $imagec): self
    {
        $this->imagec = $imagec;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbr_place;
    }

    public function setNbrPlace(int $nbr_place): self
    {
        $this->nbr_place  = $nbr_place ;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
    
/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Participation", mappedBy="campings")
 */
private $participations;

public function __construct()
{
    $this->participations = new ArrayCollection();
}

public function getParticipations(): Collection
{
    return $this->participations;
}

public function addParticipation(Participation $participation): self
{
    if (!$this->participations->contains($participation)) {
        $this->participations[] = $participation;
        $participation->addCamping($this);
    }

    return $this;
}

public function removeParticipation(Participation $participation): self
{
    if ($this->participations->contains($participation)) {
        $this->participations->removeElement($participation);
        $participation->removeCamping($this);
    }

    return $this;
}


}
