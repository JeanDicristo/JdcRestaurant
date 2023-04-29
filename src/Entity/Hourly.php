<?php

namespace App\Entity;

use App\Repository\HourlyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourlyRepository::class)]
class Hourly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 11)]
    private ?string $day = null;

    #[ORM\Column(length: 255)]
    private ?string $OpeningTime = null;

    #[ORM\Column(length: 255)]
    private ?string $ClosedTime = null;

    #[ORM\Column]
    private ?bool $closed = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningTime(): ?string
    {
        return $this->OpeningTime;
    }

    public function setOpeningTime(string $OpeningTime): self
    {
        $this->OpeningTime = $OpeningTime;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of ClosedTime
     */ 
    public function getClosedTime()
    {
        return $this->ClosedTime;
    }

    /**
     * Set the value of ClosedTime
     *
     * @return  self
     */ 
    public function setClosedTime($ClosedTime)
    {
        $this->ClosedTime = $ClosedTime;

        return $this;
    }
}
