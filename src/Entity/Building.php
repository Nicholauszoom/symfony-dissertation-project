<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BuildingRepository::class)]
class Building
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $code = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $ImagePath = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    // #[ORM\ManyToOne(inversedBy: 'building')]
    // private ?Messages $messages = null;

    // #[ORM\OneToMany(mappedBy: 'building', targetEntity: Officess::class, orphanRemoval: true)]
    // private Collection $offices;

    // #[ORM\ManyToOne(inversedBy: 'buildings')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $user = null;

    // #[ORM\ManyToMany(targetEntity: Infrastructure::class, mappedBy: 'buildind')]
    // private Collection $infrastructures;

    // #[ORM\OneToOne(mappedBy: 'buildings', cascade: ['persist', 'remove'])]
    // private ?Classroom $classroom = null;

    // #[ORM\OneToOne(mappedBy: 'building', cascade: ['persist', 'remove'])]
    // private ?Messages $messages = null;

    // public function __construct()
    // {
    //     $this->offices = new ArrayCollection();
    //     // $this->infrastructures = new ArrayCollection();
    // }

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

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->ImagePath;
    }

    public function setImagePath(string $ImagePath): self
    {
        $this->ImagePath = $ImagePath;

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

    // /**
    //  * @return Collection<int, Officess>
    //  */
    // public function getOffices(): Collection
    // {
    //     return $this->offices;
    // }

    // public function addOffice(Officess $office): self
    // {
    //     if (!$this->offices->contains($office)) {
    //         $this->offices->add($office);
    //         $office->setBuilding($this);
    //     }

    //     return $this;
    // }

    // public function removeOffice(Officess $office): self
    // {
    //     if ($this->offices->removeElement($office)) {
    //         // set the owning side to null (unless already changed)
    //         if ($office->getBuilding() === $this) {
    //             $office->setBuilding(null);
    //         }
    //     }

    //     return $this;
    // }

    public function __toString() {
        return $this->name;
    }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): self
    // {
    //     $this->user = $user;

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Infrastructure>
    //  */
    // // public function getInfrastructures(): Collection
    // {
    //     return $this->infrastructures;
    // }

    // public function addInfrastructure(Infrastructure $infrastructure): self
    // {
    //     if (!$this->infrastructures->contains($infrastructure)) {
    //         $this->infrastructures->add($infrastructure);
    //         $infrastructure->addBuildind($this);
    //     }

    //     return $this;
    // }

    // public function removeInfrastructure(Infrastructure $infrastructure): self
    // {
    //     if ($this->infrastructures->removeElement($infrastructure)) {
    //         $infrastructure->removeBuildind($this);
    //     }

    //     return $this;
    // }

    // public function getClassroom(): ?Classroom
    // {
    //     return $this->classroom;
    // }

    // public function setClassroom(Classroom $classroom): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($classroom->getBuildings() !== $this) {
    //         $classroom->setBuildings($this);
    //     }

    //     $this->classroom = $classroom;

    //     return $this;
    // }

    // public function getMessages(): ?Messages
    // {
    //     return $this->messages;
    // }

    // public function setMessages(Messages $messages): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($messages->getBuilding() !== $this) {
    //         $messages->setBuilding($this);
    //     }

    //     $this->messages = $messages;

    //     return $this;
    // }

    // public function __toString() {
    //     return $this->name;
    // }

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
            $message->setBuilding($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getBuilding() === $this) {
                $message->setBuilding(null);
            }
        }

        return $this;
    }
}
