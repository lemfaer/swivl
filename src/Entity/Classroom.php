<?php

/**
 * @noinspection PhpUnusedAliasInspection
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClassroomRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 */
// #[ApiResource]
class Classroom implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
     #[Assert\NotBlank(message: "Please enter class name")]
    protected ?string $name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected ?bool $active = false;

    /**
     * @ORM\Column(type="datetime")
     */
     #[Assert\NotBlank(message: "Please provide formed date")]
    protected ?DateTimeInterface $formed_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected ?DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTimeInterface $updated_at;

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->created_at = new DateTime("now");
    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate(): void
    {
        $this->updated_at = new DateTime("now");
    }

    /**
     * @inheritDoc
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function jsonSerialize()
    {
        /**
         * @noinspection NullPointerExceptionInspection
         */
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "active" => $this->getActive(),
            "formed_at" => $this->getFormedAt()?->format('c'),
            "created_at" => $this->getCreatedAt()?->format('c'),
            "updated_at" => $this->getUpdatedAt()?->format('c'),
        ];
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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getFormedAt(): ?DateTimeInterface
    {
        return $this->formed_at;
    }

    public function setFormedAt(DateTimeInterface $formed_at): self
    {
        $this->formed_at = $formed_at;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
