<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParticipationRepository;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idParti=null;

    #[ORM\Column(length:50)]
    private ?string $refp;

    #[ORM\Column]
    private ?int $idClient = NULL;

    #[ORM\Column]
    private ?int $idCamp = NULL;

    #[ORM\Column]
    private ?int $idRand = NULL;

    #[ORM\Column]
    private ?int $idEvents = NULL;

    #[ORM\Column]
    private ?int $nombre;

    #[ORM\Column]
    private ?float $montant;

    #[ORM\Column(length:10)]
    private ?string $etat;

    #[ORM\Column]
    private ?\DateTime $dateParti;

    #[ORM\Column(length:100)]
    private ?string $nom;

    

    public function getIdParti(): ?int
    {
        return $this->idParti;
    }

    public function getRefp(): ?string
    {
        return $this->refp;
    }

    public function setRefp(string $refp): self
    {
        $this->refp = $refp;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(?int $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdCamp(): ?int
    {
        return $this->idCamp;
    }

    public function setIdCamp(?int $idCamp): self
    {
        $this->idCamp = $idCamp;

        return $this;
    }

    public function getIdRand(): ?int
    {
        return $this->idRand;
    }

    public function setIdRand(?int $idRand): self
    {
        $this->idRand = $idRand;

        return $this;
    }

    public function getIdEvents(): ?int
    {
        return $this->idEvents;
    }

    public function setIdEvents(?int $idEvents): self
    {
        $this->idEvents = $idEvents;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDateParti(): ?\DateTimeInterface
    {
        return $this->dateParti;
    }

    public function setDateParti(\DateTimeInterface $dateParti): self
    {
        $this->dateParti = $dateParti;

        return $this;
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

    /**
     * @return Collection<int, Camping>
     */
    public function getCamping(): Collection
    {
        return $this->camping;
    }

    public function addCamping(Camping $camping): self
    {
        if (!$this->camping->contains($camping)) {
            $this->camping->add($camping);
        }

        return $this;
    }

    public function removeCamping(Camping $camping): self
    {
        $this->camping->removeElement($camping);

        return $this;
    }

 
/**
 * @ORM\ManyToMany(targetEntity="App\Entity\Camping", inversedBy="participations")
 * @ORM\JoinTable(name="participation_camping",
 *   joinColumns={
 *     @ORM\JoinColumn(name="participation_id", referencedColumnName="id")
 *   },
 *   inverseJoinColumns={
 *     @ORM\JoinColumn(name="camping_id", referencedColumnName="id")
 *   }
 * )
 */
private $campings;

public function __construct()
{
    $this->campings = new ArrayCollection();
}

public function getCampings(): Collection
{
    return $this->campings;
}




}
