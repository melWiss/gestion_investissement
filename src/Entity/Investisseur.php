<?php

namespace App\Entity;

use App\Repository\InvestisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvestisseurRepository::class)
 */
class Investisseur
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
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomSociete;

    /**
     * @ORM\OneToMany(targetEntity=Convention::class, mappedBy="Id")
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

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getNomSociete(): ?string
    {
        return $this->NomSociete;
    }

    public function setNomSociete(string $NomSociete): self
    {
        $this->NomSociete = $NomSociete;

        return $this;
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
            $convention->setMat($this);
        }

        return $this;
    }

    public function removeConvention(Convention $convention): self
    {
        if ($this->conventions->removeElement($convention)) {
            // set the owning side to null (unless already changed)
            if ($convention->getMat() === $this) {
                $convention->setMat(null);
            }
        }

        return $this;
    }
}
