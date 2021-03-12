<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultatRepository")
 */
class Resultat
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Athlete", inversedBy="resultats")
     */
    private $athlete;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classement", inversedBy="resultat")
     */
    private $classement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAthlete(): ?Athlete
    {
        return $this->athlete;
    }

    public function setAthlete(?Athlete $athlete): self
    {
        $this->athlete = $athlete;

        return $this;
    }

    public function getClassement(): ?Classement
    {
        return $this->classement;
    }

    public function setClassement(?Classement $classement): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }
}
