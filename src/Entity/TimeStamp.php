<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;


trait TimeStamp{

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private  $createdAt;

    /**
     * @return mixed
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    #[ORM\prePersist]
    public function prePersist(){
        $this->createdAt = new \DateTime();

    }
}