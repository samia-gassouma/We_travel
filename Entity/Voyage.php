<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La location ne peut pas être vide")]
    private ?string $location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de check-in ne peut pas être vide")]
    #[Assert\LessThan(value: "today", message: "La date de check-in doit être dans le passé")]
    private ?\DateTimeInterface $check_in = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de check-out ne peut pas être vide")]
    #[Assert\Expression(expression: "this.getCheckOut() >= this.getCheckIn()", message: "La date de check-out doit être postérieure à la date de check-in")]
    #[Assert\LessThan(value: "today", message: "La date de check-out doit être dans le passé")]
    private ?\DateTimeInterface $check_out = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le nombre d'adultes doit être spécifié")]
    #[Assert\Type(type: 'integer', message: "Le nombre d'adultes doit être un entier")]
    #[Assert\GreaterThanOrEqual(value: 1, message: "Le nombre d'adultes doit être supérieur ou égal à 1")]
    private ?int $nbr_adults = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le nombre d'enfants doit être spécifié")]
    #[Assert\Type(type: 'integer', message: "Le nombre d'enfants doit être un entier")]
    #[Assert\GreaterThanOrEqual(value: 0, message: "Le nombre d'enfants doit être supérieur ou égal à 0")]
    private ?int $nbr_children = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le nombre de chambres doit être spécifié")]
    #[Assert\Type(type: 'integer', message: "Le nombre de chambres doit être un entier")]
    #[Assert\GreaterThanOrEqual(value: 1, message: "Le nombre de chambres doit être supérieur ou égal à 1")]
    private ?int $nbr_chambre = null;

    //#[ORM\OneToMany(mappedBy: 'voyage', targetEntity: Hebergement::class, orphanRemoval: true)]
    #[ORM\OneToMany(mappedBy: 'voyage_id', targetEntity: Hebergement::class, orphanRemoval: true)]
    private Collection $hebergements;

    public function __construct()
    {
        $this->hebergements = new ArrayCollection();
    }

  


   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getCheckIn(): ?\DateTimeInterface
    {
        return $this->check_in;
    }

    public function setCheckIn(\DateTimeInterface $check_in): static
    {
        $this->check_in = $check_in;

        return $this;
    }

    public function getCheckOut(): ?\DateTimeInterface
    {
        return $this->check_out;
    }

    public function setCheckOut(\DateTimeInterface $check_out): static
    {
        $this->check_out = $check_out;

        return $this;
    }

    

    public function getNbrAdults(): ?int
    {
        return $this->nbr_adults;
    }

    public function setNbrAdults(int $nbr_adults): static
    {
        $this->nbr_adults = $nbr_adults;

        return $this;
    }

    public function getNbrChildren(): ?int
    {
        return $this->nbr_children;
    }

    public function setNbrChildren(int $nbr_children): static
    {
        $this->nbr_children = $nbr_children;

        return $this;
    }

    public function getNbrChambre(): ?int
    {
        return $this->nbr_chambre;
    }

    public function setNbrChambre(int $nbr_chambre): static
    {
        $this->nbr_chambre = $nbr_chambre;

        return $this;
    }

    /**
     * @return Collection<int, Hebergement>
     */
    public function getHebergements(): Collection
    {
        return $this->hebergements;
    }

    public function addHebergement(Hebergement $hebergement): static
    {
        if (!$this->hebergements->contains($hebergement)) {
            $this->hebergements->add($hebergement);
            $hebergement->setFactoryId($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): static
    {
        if ($this->hebergements->removeElement($hebergement)) {
            // set the owning side to null (unless already changed)
            if ($hebergement->getFactoryId() === $this) {
                $hebergement->setFactoryId(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->id; 
        }

   

   

    
}
