<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Hotel;


#[ORM\Entity(repositoryClass: HebergementRepository::class)]
#[Vich\Uploadable]
class Hebergement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de l'hébergement ne peut pas être vide")]
    #[Assert\Length(max: 255, maxMessage: "Le nom de l'hébergement ne peut pas dépasser {{ limit }} caractères")]
    private ?string $nomH = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le type de l'hébergement ne peut pas être vide")]
    #[Assert\Choice(choices: ['hôtel', 'appartement', 'maison', 'auberge', 'chambre d\'hôtes'], message: "Le type de l'hébergement doit être parmi : hôtel, appartement, maison, auberge, chambre d'hôtes")]
    private ?string $type = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "La qualité de l'hébergement ne peut pas être vide")]
    #[Assert\Choice(choices: ['économique', 'standard', 'supérieure', 'luxueuse'], message: "La qualité de l'hébergement doit être parmi : économique, standard, supérieure, luxueuse")]
    private ?string $qualite = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "Le nombre de chambres ne peut pas être vide")]
    #[Assert\PositiveOrZero(message: "Le nombre de chambres doit être un nombre positif ou zéro")]
    private ?int $nombre_chambre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La liste d'activités de l'hébergement ne peut pas être vide")]
    #[Assert\Length(max: 255, maxMessage: "La liste d'activités ne peut pas dépasser {{ limit }} caractères")]
    private ?string $liste_activite = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: "Le prix ne peut pas être vide")]
    #[Assert\Positive(message: "Le prix doit être un nombre positif")]
    private ?float $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url(message: "L'URL de l'image n'est pas valide")]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'products_images', fileNameProperty: 'image')]
    private ?File $imageFile = null;


    #[ORM\ManyToOne(inversedBy: 'hebergements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Voyage $voyage_id = null;
   
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomH(): ?string
    {
        return $this->nomH;
    }

    public function setNomH(?string $nomH): self
    {
        $this->nomH = $nomH;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQualite(): ?string
    {
        return $this->qualite;
    }

    public function setQualite(?string $qualite): self
    {
        $this->qualite = $qualite;

        return $this;
    }

    public function getNombreChambre(): ?int
    {
        return $this->nombre_chambre;
    }

    public function setNombreChambre(?int $nombre_chambre): self
    {
        $this->nombre_chambre = $nombre_chambre;

        return $this;
    }

    public function getListeActivite(): ?string
    {
        return $this->liste_activite;
    }

    public function setListeActivite(?string $liste_activite): self
    {
        $this->liste_activite = $liste_activite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function setImageFile( $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getVoyageId(): ?Voyage
    {
        return $this->voyage_id;
    }

    public function setVoyageId(?Voyage $voyage_id): self
    {
        $this->voyage_id = $voyage_id;

        return $this;
    }
}
