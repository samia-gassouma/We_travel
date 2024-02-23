<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "le type ne doit pas être vide")]
    private ?string $type = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
      
    private ?\DateTimeInterface $datefin = null;

    #[ORM\Column]
    #[Assert\GreaterThan(
        value: 0,
        message: "La valeur de prix  doit être supérieure à zéro"
    )]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le lieux  ne doit pas être vide")]
    private ?string $lieux = null;

    #[ORM\ManyToOne(inversedBy: 'Reference')]
    private ?Commentaire $Ref = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): static
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): static
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): static
    {
        $this->lieux = $lieux;

        return $this;
    }

    public function getRef(): ?Commentaire
    {
        return $this->Ref;
    }

    public function setRef(?Commentaire $Ref): static
    {
        $this->Ref = $Ref;

        return $this;
    }
}
