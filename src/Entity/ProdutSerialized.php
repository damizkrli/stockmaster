<?php

namespace App\Entity;

use App\Repository\ProdutSerializedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutSerializedRepository::class)]
class ProdutSerialized
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $serial_number = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(string $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
