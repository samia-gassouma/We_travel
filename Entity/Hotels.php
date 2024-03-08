<?php

namespace App\Entity;

use App\Repository\HotelsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Reservation;

#[ORM\Entity(repositoryClass: HotelsRepository::class)]
class Hotels
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 6, nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 6, nullable: true)]
    private ?float $latitude = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getLongitude(): ?float
{
    return $this->longitude;
}

public function setLongitude(?float $longitude): static
{
    $this->longitude = $longitude;

    return $this;
}

public function getLatitude(): ?float
{
    return $this->latitude;
}

public function setLatitude(?float $latitude): static
{
    $this->latitude = $latitude;

    return $this;
}


}
