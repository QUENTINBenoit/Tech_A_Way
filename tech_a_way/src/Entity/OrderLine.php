<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderLineRepository::class)
 */
class OrderLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $product_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $excl_taxes_unit_price;

    /**
     * @ORM\Column(type="smallint")
     */
    private $sales_tax;

    /**
     * @ORM\Column(type="float")
     */
    private $incl_taxes_unit_price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_At;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_At;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

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

    public function getExclTaxesUnitPrice(): ?float
    {
        return $this->excl_taxes_unit_price;
    }

    public function setExclTaxesUnitPrice(float $excl_taxes_unit_price): self
    {
        $this->excl_taxes_unit_price = $excl_taxes_unit_price;

        return $this;
    }

    public function getSalesTax(): ?int
    {
        return $this->sales_tax;
    }

    public function setSalesTax(int $sales_tax): self
    {
        $this->sales_tax = $sales_tax;

        return $this;
    }

    public function getInclTaxesUnitPrice(): ?float
    {
        return $this->incl_taxes_unit_price;
    }

    public function setInclTaxesUnitPrice(float $incl_taxes_unit_price): self
    {
        $this->incl_taxes_unit_price = $incl_taxes_unit_price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeInterface $created_At): self
    {
        $this->created_At = $created_At;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_At;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_At): self
    {
        $this->updated_At = $updated_At;

        return $this;
    }
}
