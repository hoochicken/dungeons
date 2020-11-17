<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route", indexes={@ORM\Index(name="IDX_2C42079A6C15F13", columns={"place_out_id"})})
 * @ORM\Entity
 */
class Route
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="place_out", type="integer", nullable=false)
     */
    private $placeOut;

    /**
     * @var int
     *
     * @ORM\Column(name="place_in", type="integer", nullable=false)
     */
    private $placeIn;

    /**
     * @var int
     *
     * @ORM\Column(name="out_direction", type="integer", nullable=false)
     */
    private $outDirection;

    /**
     * @var string
     *
     * @ORM\Column(name="attributes", type="string", length=1023, nullable=false, options={"default"="{}"})
     */
    private $attributes = '{}';

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean", nullable=false, options={"default"="1"})
     */
    private $state = true;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="created_user", type="integer", nullable=false)
     */
    private $createdUser;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var int
     *
     * @ORM\Column(name="updated_user", type="integer", nullable=false)
     */
    private $updatedUser;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @var int
     *
     * @ORM\Column(name="deleted_user", type="integer", nullable=false)
     */
    private $deletedUser;

    /**
     * @var \Place
     *
     * @ORM\ManyToOne(targetEntity="Place")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="place_out_id", referencedColumnName="id")
     * })
     */
    private $placeOut2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaceOut(): ?int
    {
        return $this->placeOut;
    }

    public function setPlaceOut(int $placeOut): self
    {
        $this->placeOut = $placeOut;

        return $this;
    }

    public function getPlaceIn(): ?int
    {
        return $this->placeIn;
    }

    public function setPlaceIn(int $placeIn): self
    {
        $this->placeIn = $placeIn;

        return $this;
    }

    public function getOutDirection(): ?int
    {
        return $this->outDirection;
    }

    public function setOutDirection(int $outDirection): self
    {
        $this->outDirection = $outDirection;

        return $this;
    }

    public function getAttributes(): ?string
    {
        return $this->attributes;
    }

    public function setAttributes(string $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getCreatedUser(): ?int
    {
        return $this->createdUser;
    }

    public function setCreatedUser(int $createdUser): self
    {
        $this->createdUser = $createdUser;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdatedUser(): ?int
    {
        return $this->updatedUser;
    }

    public function setUpdatedUser(int $updatedUser): self
    {
        $this->updatedUser = $updatedUser;

        return $this;
    }

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getDeletedUser(): ?int
    {
        return $this->deletedUser;
    }

    public function setDeletedUser(int $deletedUser): self
    {
        $this->deletedUser = $deletedUser;

        return $this;
    }

    public function getPlaceOut2(): ?Place
    {
        return $this->placeOut2;
    }

    public function setPlaceOut2(?Place $placeOut2): self
    {
        $this->placeOut2 = $placeOut2;

        return $this;
    }


}
