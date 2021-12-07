<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LibelleP;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecteurP;

    /**
     * @ORM\Column(type="integer")
     */
    private $CoutFixe;

    /**
     * @ORM\Column(type="integer")
     */
    private $CoutVar;

    /**
     * @ORM\Column(type="date")
     */
    private $DureeP;

    /**
     * @ORM\OneToMany(targetEntity=Convention::class, mappedBy="Id", orphanRemoval=true)
     */
    private $conventions;

    public function __construct()
    {
        $this->conventions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleP(): ?string
    {
        return $this->LibelleP;
    }

    public function setLibelleP(string $LibelleP): self
    {
        $this->LibelleP = $LibelleP;

        return $this;
    }

    public function getSecteurP(): ?string
    {
        return $this->SecteurP;
    }

    public function setSecteurP(string $SecteurP): self
    {
        $this->SecteurP = $SecteurP;

        return $this;
    }

    public function getCoutFixe(): ?int
    {
        return $this->CoutFixe;
    }

    public function setCoutFixe(int $CoutFixe): self
    {
        $this->CoutFixe = $CoutFixe;

        return $this;
    }

    public function getCoutVar(): ?int
    {
        return $this->CoutVar;
    }

    public function setCoutVar(int $CoutVar): self
    {
        $this->CoutVar = $CoutVar;

        return $this;
    }

    public function getDureeP(): ?\DateTimeInterface
    {
        return $this->DureeP;
    }

    public function setDureeP(\DateTimeInterface $DureeP): self
    {
        $this->DureeP = $DureeP;

        return $this;
    }

    public function __toString() {
        return $this->LibelleP;
    }

    /**
     * @return Collection|Convention[]
     */
    public function getConventions(): Collection
    {
        return $this->conventions;
    }

    public function addConvention(Convention $convention): self
    {
        if (!$this->conventions->contains($convention)) {
            $this->conventions[] = $convention;
            $convention->setCodeP($this);
        }

        return $this;
    }

    public function removeConvention(Convention $convention): self
    {
        if ($this->conventions->removeElement($convention)) {
            // set the owning side to null (unless already changed)
            if ($convention->getCodeP() === $this) {
                $convention->setCodeP(null);
            }
        }

        return $this;
    }
}
