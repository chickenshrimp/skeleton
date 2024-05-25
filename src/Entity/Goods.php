<?php

namespace App\Entity;

use App\Repository\GoodsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoodsRepository::class)]
class Goods
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $good_name = null;

    #[ORM\Column]
    private ?int $cost = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shops $shop_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoodName(): ?string
    {
        return $this->good_name;
    }

    public function setGoodName(string $good_name): static
    {
        $this->good_name = $good_name;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getShopId(): ?Shops
    {
        return $this->shop_id;
    }

    public function setShopId(?Shops $shop_id): static
    {
        $this->shop_id = $shop_id;

        return $this;
    }
}
