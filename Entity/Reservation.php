<?php

namespace App\Entity;


use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Hotels;
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Hotels::class)]
    #[ORM\JoinColumn(name: "hotel_id", referencedColumnName: "id", nullable: true)]
    private ?Hotel $hotel = null;

    #[ORM\Column(type: "integer" , nullable: true)]
    private ?int $numberOfDays = null;

    #[ORM\Column(type: "integer")]
    private ?int $numberOfPersons = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateFrom = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateTo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getNumberOfDays(): ?int
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(?int $numberOfDays): self
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }

    public function getNumberOfPersons(): ?int
    {
        return $this->numberOfPersons;
    }

    public function setNumberOfPersons(?int $numberOfPersons): self
    {
        $this->numberOfPersons = $numberOfPersons;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(?\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }
}

