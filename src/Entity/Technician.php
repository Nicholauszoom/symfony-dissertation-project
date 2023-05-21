<?php

namespace App\Entity;

use App\Repository\TechnicianRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnicianRepository::class)]
class Technician
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $profession = null;

    // #[ORM\ManyToOne(inversedBy: 'technicns')]
    // private ?Task $task = null;

    // #[ORM\ManyToOne(inversedBy: 'technicians')]
    // private ?Task $task = null;

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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    // public function getTask(): ?Task
    // {
    //     return $this->task;
    // }

    // public function setTask(?Task $task): self
    // {
    //     $this->task = $task;

    //     return $this;
    // }
    public function __toString() {
        return $this->email;
    }
   
}
