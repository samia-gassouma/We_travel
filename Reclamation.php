<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"AUTO")]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $type = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\Type(type:"\DateTimeInterface", message:"Invalid date format.")]
    #[Assert\LessThan(['value' => 'today'])]
    private ?\DateTimeInterface $date = null;

    #[Assert\NotBlank(message:"Not blank allowed")]
    #[ORM\Column(length: 2000)]
    #[Assert\Length(min : 3,max : 10,minMessage : "The value must be at least {{ limit }} characters long",maxMessage : "The value cannot be longer than {{ limit }} characters")]
    #[Assert\Regex(pattern:"/^[A-Z]/",message:"The value must start with an uppercase letter.")]

    private ?string $description = null;

    #[ORM\Column(length: 20)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'reclamation', targetEntity: Reponse::class,orphanRemoval: true)]
    private Collection $reponse;

    #[ORM\ManyToOne(inversedBy: 'reclamations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $client = null;

    #[ORM\ManyToOne(inversedBy: 'reclamations')]
    private ?Reservation $reservation = null;

    #[ORM\ManyToOne(inversedBy: 'reclamations')]
    private ?Paiement $paiement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_envoi = null;

    public function __construct()
    {
        $this->reponse = new ArrayCollection();
    }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponse(): Collection
    {
        return $this->reponse;
    }

    public function addReponse(Reponse $reponse): static
    {
        if (!$this->reponse->contains($reponse)) {
            $this->reponse->add($reponse);
            $reponse->setReclamation($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): static
    {
        if ($this->reponse->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getReclamation() === $this) {
                $reponse->setReclamation(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Utilisateur
    {
        return $this->client;
    }

    public function setClient(Utilisateur $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    
    public function __toString()
    {
        return $this->id. " ".$this->type." ".$this->description;
    }

    public function getDate_Envoi(): ?\DateTimeInterface
    {
        return $this->date_envoi;
    }

    public function setDate_Envoi(\DateTimeInterface $date_envoi): static
    {
        $this->date_envoi = $date_envoi;

        return $this;
    }

}
