<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=60)
     */
    private $typeDelivery;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $streetDelivery;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "Le code postal ext composé de 5 chiffres",
     *      maxMessage = "Le code postal ext composé de 5 chiffres"
     * )
     */
    private $zipcodeDelivery;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $cityDelivery;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $streetBill;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "Le code postal ext composé de 5 chiffres",
     *      maxMessage = "Le code postal ext composé de 5 chiffres"
     * )
     */
    private $zipcodeBill;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $cityBill;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="anOrder")
     */
    private $orderLines;

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
        $this->orderLines = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeDelivery(): ?string
    {
        return $this->typeDelivery;
    }

    public function setTypeDelivery(string $typeDelivery): self
    {
        $this->typeDelivery = $typeDelivery;

        return $this;
    }

    public function getStreetDelivery(): ?string
    {
        return $this->streetDelivery;
    }

    public function setStreetDelivery(string $streetDelivery): self
    {
        $this->streetDelivery = $streetDelivery;

        return $this;
    }

    public function getZipcodeDelivery(): ?int
    {
        return $this->zipcodeDelivery;
    }

    public function setZipcodeDelivery(int $zipcodeDelivery): self
    {
        $this->zipcodeDelivery = $zipcodeDelivery;

        return $this;
    }

    public function getCityDelivery(): ?string
    {
        return $this->cityDelivery;
    }

    public function setCityDelivery(string $cityDelivery): self
    {
        $this->cityDelivery = $cityDelivery;

        return $this;
    }

    public function getStreetBill(): ?string
    {
        return $this->streetBill;
    }

    public function setStreetBill(string $streetBill): self
    {
        $this->streetBill = $streetBill;

        return $this;
    }

    public function getZipcodeBill(): ?int
    {
        return $this->zipcodeBill;
    }

    public function setZipcodeBill(int $zipcodeBill): self
    {
        $this->zipcodeBill = $zipcodeBill;

        return $this;
    }

    public function getCityBill(): ?string
    {
        return $this->cityBill;
    }

    public function setCityBill(string $cityBill): self
    {
        $this->cityBill = $cityBill;

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
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setAnOrder($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->removeElement($orderLine)) {
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
