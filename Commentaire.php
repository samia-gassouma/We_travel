<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "le contenu  ne doit pas être vide")]
    private ?string $contenu = null;

    #[ORM\OneToMany(mappedBy: 'Ref', targetEntity: Event::class)]
    private Collection $Reference;

    public function __construct()
    {
        $this->Reference = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

   

   

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getReference(): Collection
    {
        return $this->Reference;
    }

    public function addReference(Event $reference): static
    {
        if (!$this->Reference->contains($reference)) {
            $this->Reference->add($reference);
            $reference->setRef($this);
        }

        return $this;
    }

    public function removeReference(Event $reference): static
    {
        if ($this->Reference->removeElement($reference)) {
            // set the owning side to null (unless already changed)
            if ($reference->getRef() === $this) {
                $reference->setRef(null);
            }
        }

        return $this;
    }
}
