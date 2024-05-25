<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $surname = null;

    #[ORM\Column(length: 60)]
    private ?string $login = null;

    #[ORM\Column(length: 60)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $has_ability_for_shop = null;

    #[ORM\Column]
    private ?bool $admin_role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isHasAbilityForShop(): ?bool
    {
        return $this->has_ability_for_shop;
    }

    public function setHasAbilityForShop(bool $has_ability_for_shop): static
    {
        $this->has_ability_for_shop = $has_ability_for_shop;

        return $this;
    }

    public function isAdminRole(): ?bool
    {
        return $this->admin_role;
    }

    public function setAdminRole(bool $admin_role): static
    {
        $this->admin_role = $admin_role;

        return $this;
    }
}
