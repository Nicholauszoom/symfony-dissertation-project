<?php

namespace App\Entity;

use App\Repository\InfrastructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InfrastructureRepository::class)]
class Infrastructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $imagePath = null;

    #[ORM\ManyToMany(targetEntity: Classroom::class, mappedBy: 'infrastructure')]
    private Collection $classrooms;

    #[ORM\OneToMany(mappedBy: 'infrastructure', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $messages;

    // #[ORM\ManyToOne(inversedBy: 'infrastructure')]
    // private ?Messages $messages = null;

    // #[ORM\OneToOne(mappedBy: 'infrastructure', cascade: ['persist', 'remove'])]
    // private ?Messages $messages = null;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return Collection<int, Classroom>
     */
    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): self
    {
        if (!$this->classrooms->contains($classroom)) {
            $this->classrooms->add($classroom);
            $classroom->addInfrastructure($this);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): self
    {
        if ($this->classrooms->removeElement($classroom)) {
            $classroom->removeInfrastructure($this);
        }

        return $this;
    }

    // public function getMessages(): ?Messages
    // {
    //     return $this->messages;
    // }

    // public function setMessages(Messages $messages): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($messages->getInfrastructure() !== $this) {
    //         $messages->setInfrastructure($this);
    //     }

    //     $this->messages = $messages;

    //     return $this;
    // }

    public function __toString() {
        return $this->name;
    }

    public function getMessages(): ?Messages
    {
        return $this->messages;
    }

    public function setMessages(?Messages $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setInfrastructure($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getInfrastructure() === $this) {
                $message->setInfrastructure(null);
            }
        }

        return $this;
    }


}
