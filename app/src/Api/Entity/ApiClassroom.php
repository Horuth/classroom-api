<?php

namespace App\Api\Entity;

use DateTimeInterface;

class ApiClassroom implements ApiInstanceInterface
{
    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var DateTimeInterface $creationDate */
    private $creationDate;

    /** @var bool $isActive */
    private $isActive;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreationDate(): DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'creationDate' => $this->getCreationDate()->format('Y-m-d H:m:s'),
            'isActive' => $this->getIsActive(),
        ];
    }
}
