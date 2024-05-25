<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    //доделай плз
    #[ORM\Column]
    private int $user_id;

    #[ORM\OneToOne(targetEntity: Goods::class)]
    private Goods $good_id;


//    public function __construct()
//    {
//        $this->user_id = new ArrayCollection();
//        $this->good_id = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }


    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): static
    {
        $this->user_id = $userId;

        return $this;
    }

    public function getGoodId(): Goods
    {
        return $this->good_id;
    }

    public function setGoodId(Goods $goodId): static
    {
        $this->good_id = $goodId;
        return $this;
    }
}
