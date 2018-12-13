<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * id de la table saison
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * numero d'une saison de la serie
     */
    private $numero_season;

    /**
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="listSeasons")
     * renvoie à une serie
     */
    private $oneSerie;

    /**
     * @ORM\OneToMany(targetEntity="Episode", mappedBy="oneSeason")
     * liste des episodes
     */
    private $listEpisodes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSeason(): ?string
    {
        return $this->numero_season;
    }

    public function setNumeroSeason(string $numero_season): self
    {
        $this->numero_season = $numero_season;

        return $this;
    }
}
