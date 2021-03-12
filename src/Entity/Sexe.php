<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SexeRepository")
 */
class Sexe
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
     * @ORM\OneToMany(targetEntity="App\Entity\Athlete", mappedBy="sexe")
     */
    private $athletes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entraineur", mappedBy="sexe")
     */
    private $entraineurs;

    public function __construct()
    {
        $this->athletes = new ArrayCollection();
        $this->entraineurs = new ArrayCollection();
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
     * @return Collection|Athlete[]
     */
    public function getAthletes(): Collection
    {
        return $this->athletes;
    }

    public function addAthlete(Athlete $athlete): self
    {
        if (!$this->athletes->contains($athlete)) {
            $this->athletes[] = $athlete;
            $athlete->setSexe($this);
        }

        return $this;
    }

    public function removeAthlete(Athlete $athlete): self
    {
        if ($this->athletes->contains($athlete)) {
            $this->athletes->removeElement($athlete);
            // set the owning side to null (unless already changed)
            if ($athlete->getSexe() === $this) {
                $athlete->setSexe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entraineur[]
     */
    public function getEntraineurs(): Collection
    {
        return $this->entraineurs;
    }

    public function addEntraineur(Entraineur $entraineur): self
    {
        if (!$this->entraineurs->contains($entraineur)) {
            $this->entraineurs[] = $entraineur;
            $entraineur->setSexe($this);
        }

        return $this;
    }

    public function removeEntraineur(Entraineur $entraineur): self
    {
        if ($this->entraineurs->contains($entraineur)) {
            $this->entraineurs->removeElement($entraineur);
            // set the owning side to null (unless already changed)
            if ($entraineur->getSexe() === $this) {
                $entraineur->setSexe(null);
            }
        }

        return $this;
    }
}
