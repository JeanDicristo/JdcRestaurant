<?php

namespace App\Entity;

use App\Repository\AllergyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergyRepository::class)]
class Allergy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: ProfilUser::class, mappedBy: 'allergy')]
    private Collection $profilUsers;

    public function __construct()
    {
        $this->profilUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, ProfilUser>
     */
    public function getProfilUsers(): Collection
    {
        return $this->profilUsers;
    }

    public function addProfilUser(ProfilUser $profilUser): self
    {
        if (!$this->profilUsers->contains($profilUser)) {
            $this->profilUsers->add($profilUser);
            $profilUser->addAllergy($this);
        }

        return $this;
    }

    public function removeProfilUser(ProfilUser $profilUser): self
    {
        if ($this->profilUsers->removeElement($profilUser)) {
            $profilUser->removeAllergy($this);
        }

        return $this;
    }
}
