<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $excl_taxes_price;

    /**
     * @ORM\Column(type="smallint")
     */
    private $sales_tax;

    /**
     * @ORM\Column(type="float")
     */
    private $incl_taxes_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $reference;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status_recent;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status_promotion;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $percentage_promotion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinTable(name="product_category")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="product", orphanRemoval=true)
     */
    private $pictures;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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

    public function getExclTaxesPrice(): ?float
    {
        return $this->excl_taxes_price;
    }

    public function setExclTaxesPrice(float $excl_taxes_price): self
    {
        $this->excl_taxes_price = $excl_taxes_price;

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

    public function getInclTaxesPrice(): ?float
    {
        return $this->incl_taxes_price;
    }

    public function setInclTaxesPrice(float $incl_taxes_price): self
    {
        $this->incl_taxes_price = $incl_taxes_price;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getStatusRecent(): ?int
    {
        return $this->status_recent;
    }

    public function setStatusRecent(?int $status_recent): self
    {
        $this->status_recent = $status_recent;

        return $this;
    }

    public function getStatusPromotion(): ?int
    {
        return $this->status_promotion;
    }

    public function setStatusPromotion(?int $status_promotion): self
    {
        $this->status_promotion = $status_promotion;

        return $this;
    }

    public function getPercentagePromotion(): ?int
    {
        return $this->percentage_promotion;
    }

    public function setPercentagePromotion(?int $percentage_promotion): self
    {
        $this->percentage_promotion = $percentage_promotion;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

        return $this;
    }
}
