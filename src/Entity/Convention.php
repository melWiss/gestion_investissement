<?php

namespace App\Entity;

use App\Repository\ConventionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConventionRepository::class)
 */
class Convention
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="conventions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeP;

    /**
     * @ORM\ManyToOne(targetEntity=Investisseur::class, inversedBy="conventions")
     */
    private $Mat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeP(): ?Projet
    {
        return $this->CodeP;
    }

    public function setCodeP(?Projet $CodeP): self
    {
        $this->CodeP = $CodeP;

        return $this;
    }

    public function getMat(): ?Investisseur
    {
        return $this->Mat;
    }

    public function setMat(?Investisseur $Mat): self
    {
        $this->Mat = $Mat;

        return $this;
    }
}
