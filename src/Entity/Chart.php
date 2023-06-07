<?php

namespace App\Entity;

use App\Repository\ChartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChartRepository::class)]


#[ORM\HasLifecycleCallbacks]
class Chart
{

    use TimeStamp;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Conversation $conversation = null;

    #[ORM\ManyToOne]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;


    // private content;

    // #[ORM\ManyToOne(inversedBy: 'message')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Conversation $conversation = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getConversation(): ?Conversation
    // {
    //     return $this->conversation;
    // }

    // public function setConversation(?Conversation $conversation): self
    // {
    //     $this->conversation = $conversation;

    //     return $this;
    // }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

}
