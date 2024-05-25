<?php

namespace App\Entity;

use App\Repository\ShopsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopsRepository::class)]
class Shops
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $shop_name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $owner_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShopName(): ?string
    {
        return $this->shop_name;
    }

    public function setShopName(string $shop_name): static
    {
        $this->shop_name = $shop_name;

        return $this;
    }

    public function getOwnerId(): ?Users
    {
        return $this->owner_id;
    }

    public function setOwnerId(Users $owner_id): static
    {
        $this->owner_id = $owner_id;

        return $this;
    }

}
