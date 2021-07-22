<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $type_delivery;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $street_delivery;

    /**
     * @ORM\Column(type="smallint")
     */
    private $zipcode_delivery;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $city_delivery;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $street_bill;

    /**
     * @ORM\Column(type="smallint")
     */
    private $zipcode_bill;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $city_bill;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="anOrder")
     */
    private $order_lines;

    /**
     * @ORM\ManyToOne(targetEntity=ModeOfPayment::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modeOfPayment;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->order_lines = new ArrayCollection();
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTypeDelivery(): ?string
    {
        return $this->type_delivery;
    }

    public function setTypeDelivery(string $type_delivery): self
    {
        $this->type_delivery = $type_delivery;

        return $this;
    }

    public function getStreetDelivery(): ?string
    {
        return $this->street_delivery;
    }

    public function setStreetDelivery(string $street_delivery): self
    {
        $this->street_delivery = $street_delivery;

        return $this;
    }

    public function getZipcodeDelivery(): ?int
    {
        return $this->zipcode_delivery;
    }

    public function setZipcodeDelivery(int $zipcode_delivery): self
    {
        $this->zipcode_delivery = $zipcode_delivery;

        return $this;
    }

    public function getCityDelivery(): ?string
    {
        return $this->city_delivery;
    }

    public function setCityDelivery(string $city_delivery): self
    {
        $this->city_delivery = $city_delivery;

        return $this;
    }

    public function getStreetBill(): ?string
    {
        return $this->street_bill;
    }

    public function setStreetBill(string $street_bill): self
    {
        $this->street_bill = $street_bill;

        return $this;
    }

    public function getZipcodeBill(): ?int
    {
        return $this->zipcode_bill;
    }

    public function setZipcodeBill(int $zipcode_bill): self
    {
        $this->zipcode_bill = $zipcode_bill;

        return $this;
    }

    public function getCityBill(): ?string
    {
        return $this->city_bill;
    }

    public function setCityBill(string $city_bill): self
    {
        $this->city_bill = $city_bill;

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

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getOrderLines(): Collection
    {
        return $this->order_lines;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->order_lines->contains($orderLine)) {
            $this->order_lines[] = $orderLine;
            $orderLine->setAnOrder($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->order_lines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getAnOrder() === $this) {
                $orderLine->setAnOrder(null);
            }
        }

        return $this;
    }

    public function getModeOfPayment(): ?ModeOfPayment
    {
        return $this->modeOfPayment;
    }

    public function setModeOfPayment(?ModeOfPayment $modeOfPayment): self
    {
        $this->modeOfPayment = $modeOfPayment;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
