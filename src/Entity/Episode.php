<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EpisodeRepository")
 */
class Episode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * id de la table episode
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * titre de l'episode
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     * numero de l'episode d'une saison dans une serie
     */
    private $numero_episode;

    /**
     * @ORM\ManyToOne(targetEntity="Season", inversedBy="listEpisodes")
     * renvoie a une saison
     */
    private $oneSeason;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNumeroEpisode(): ?string
    {
        return $this->numero_episode;
    }

    public function setNumeroEpisode(string $numero_episode): self
    {
        $this->numero_episode = $numero_episode;

        return $this;
    }

}
