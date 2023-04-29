<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: Formula::class)]
    private Collection $formula;

    public function __construct()
    {
        $this->formula = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getName();
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

    /**
     * @return Collection<int, Formula>
     */
    public function getFormula(): Collection
    {
        return $this->formula;
    }

    public function addFormula(Formula $formula): self
    {
        if (!$this->formula->contains($formula)) {
            $this->formula->add($formula);
            $formula->setMenu($this);
        }

        return $this;
    }

    public function removeFormula(Formula $formula): self
    {
        if ($this->formula->removeElement($formula)) {
            // set the owning side to null (unless already changed)
            if ($formula->getMenu() === $this) {
                $formula->setMenu(null);
            }
        }

        return $this;
    }
}
