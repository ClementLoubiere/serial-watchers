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
     */
    private $id;

    /**
     * @var Episode
     * @ORM\ManyToOne(targetEntity="Episode", inversedBy="nb_episodes")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(type="integer")
     */
    private $nb_seasons;

    /**
     * @var Serie
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="season")
     */
    // pas de getter/setter pour le moment
    private $serie;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Episode
     */
    public function getNbSeasons(): Episode
    {
        return $this->nb_seasons;
    }

    /**
     * @param Episode $nb_seasons
     * @return Season
     */
    public function setNbSeasons(Episode $nb_seasons): Season
    {
        $this->nb_seasons = $nb_seasons;
        return $this;
    }


}
