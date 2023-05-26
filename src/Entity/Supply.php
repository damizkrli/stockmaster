<?php

namespace App\Entity;

use App\Repository\SupplyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SupplyRepository::class)]
class Supply
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Cette valeur ne peut pas être vide.')]
    #[Assert\Length(
        min: '3',
        max: '75',
        minMessage: 'La désignation ne doit pas être inférieure à {{ limit }} caractères',
        maxMessage: 'La désignation ne doit pas être supérieure à {{ limit }} caractères',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Cette valeur ne peut pas être vide.')]
    #[Assert\Length(
        min: '3',
        max: '75',
        minMessage: 'La référence ne doit pas être inférieure à {{ limit }} caractères',
        maxMessage: 'La référence ne doit pas être supérieure à {{ limit }} caractères',
    )]
    private ?string $reference = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero(message: 'La quantité doit être de 0 ou plus.')]
    #[Assert\NotBlank(message: 'Cette valeur ne peut être vide.')]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $addedAt = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Un produit doit avoir une marque.')]
    #[Assert\Length(
        min: '3',
        max: '50',
        minMessage: 'La marque ne doit pas être inférieure à {{ limit }} caractères',
        maxMessage: 'La marque ne doit pas être supérieure à {{ limit }} caractères',
    )]
    private ?string $brand = null;

    public function __construct()
    {
        $this->addedAt = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->name;
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

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

    public function getAddedAt(): ?\DateTimeImmutable
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeImmutable $addedAt): self
    {
        $this->addedAt = $addedAt;

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
