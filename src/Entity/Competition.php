<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
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
    private $titre;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_publication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultat", mappedBy="competition", orphanRemoval=true)
     */
    private $resultats;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discipline", inversedBy="competitions")
     */
    private $discipline;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entraineur", inversedBy="competitions")
     */
    private $entraineur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commmentaire", mappedBy="compeition", orphanRemoval=true)
     */
    private $commmentaires;

    public function __construct()
    {
        $this->resultats = new ArrayCollection();
        $this->date_publication = new \DateTime();
        $this->commmentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }
    public function getSlug():?string {
        $slug = new Slugify();
        return $slug->slugify($this->getTitre());
    }
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
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
    /**
     * @return Collection|Resultat[]
     */
    public function getResultats(): Collection
    {
        return $this->resultats;
    }

    public function addResultat(Resultat $resultat): self
    {
        if (!$this->resultats->contains($resultat)) {
            $this->resultats[] = $resultat;
            $resultat->setCompetition($this);
        }

        return $this;
    }

    public function removeResultat(Resultat $resultat): self
    {
        if ($this->resultats->contains($resultat)) {
            $this->resultats->removeElement($resultat);
            // set the owning side to null (unless already changed)
            if ($resultat->getCompetition() === $this) {
                $resultat->setCompetition(null);
            }
        }

        return $this;
    }

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getEntraineur(): ?Entraineur
    {
        return $this->entraineur;
    }

    public function setEntraineur(?Entraineur $entraineur): self
    {
        $this->entraineur = $entraineur;

        return $this;
    }

    /**
     * @return Collection|Commmentaire[]
     */
    public function getCommmentaires(): Collection
    {
        return $this->commmentaires;
    }

    public function addCommmentaire(Commmentaire $commmentaire): self
    {
        if (!$this->commmentaires->contains($commmentaire)) {
            $this->commmentaires[] = $commmentaire;
            $commmentaire->setCompeition($this);
        }

        return $this;
    }

    public function removeCommmentaire(Commmentaire $commmentaire): self
    {
        if ($this->commmentaires->contains($commmentaire)) {
            $this->commmentaires->removeElement($commmentaire);
            // set the owning side to null (unless already changed)
            if ($commmentaire->getCompeition() === $this) {
                $commmentaire->setCompeition(null);
            }
        }

        return $this;
    }

}
