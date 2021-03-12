<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassementRepository")
 */
class Classement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultat", mappedBy="classement")
     */
    private $resultat;

    public function __construct()
    {
        $this->resultat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Resultat[]
     */
    public function getResultat(): Collection
    {
        return $this->resultat;
    }

    public function addResultat(Resultat $resultat): self
    {
        if (!$this->resultat->contains($resultat)) {
            $this->resultat[] = $resultat;
            $resultat->setClassement($this);
        }

        return $this;
    }

    public function removeResultat(Resultat $resultat): self
    {
        if ($this->resultat->contains($resultat)) {
            $this->resultat->removeElement($resultat);
            // set the owning side to null (unless already changed)
            if ($resultat->getClassement() === $this) {
                $resultat->setClassement(null);
            }
        }

        return $this;
    }
}
