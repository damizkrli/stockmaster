<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0, message: 'Vous devez ajouter au moins un produit.')]
    #[Assert\NotBlank(message: 'Cette valeur ne peut être vide.')]
    private ?int $quantity = null;

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

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Un produit doit avoir une marque.')]
    #[Assert\Length(
        min: '3',
        max: '50',
        minMessage: 'La marque ne doit pas être inférieure à {{ limit }} caractères',
        maxMessage: 'La marque ne doit pas être supérieure à {{ limit }} caractères',
    )]
    private ?string $brand = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $addedAt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serial_number = null;

    public function __toString(): string
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->addedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(?string $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    /**
     * Diminuer la quantité du produit de la quantité spécifiée.
     */
    public function decreaseQuantity(int $quantity): void
    {
        $this->quantity -= $quantity;

        if ($this->quantity < 0) {
            $this->quantity = 0;
        }
    }
}
