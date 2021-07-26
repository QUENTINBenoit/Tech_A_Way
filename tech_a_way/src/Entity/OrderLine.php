<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

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
    private $productName;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $exclTaxesUnitPrice;

    /**
     * @ORM\Column(type="smallint")
     */
    private $salesTax;

    /**
     * @ORM\Column(type="float")
     */
    private $inclTaxesUnitPrice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anOrder;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

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
        return $this->exclTaxesUnitPrice;
    }

    public function setExclTaxesUnitPrice(float $exclTaxesUnitPrice): self
    {
        $this->exclTaxesUnitPrice = $exclTaxesUnitPrice;

        return $this;
    }

    public function getSalesTax(): ?int
    {
        return $this->salesTax;
    }

    public function setSalesTax(int $salesTax): self
    {
        $this->salesTax = $salesTax;

        return $this;
    }

    public function getInclTaxesUnitPrice(): ?float
    {
        return $this->inclTaxesUnitPrice;
    }

    public function setInclTaxesUnitPrice(float $inclTaxesUnitPrice): self
    {
        $this->inclTaxesUnitPrice = $inclTaxesUnitPrice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAnOrder(): ?Order
    {
        return $this->anOrder;
    }

    public function setAnOrder(?Order $anOrder): self
    {
        $this->anOrder = $anOrder;

        return $this;
    }
}
