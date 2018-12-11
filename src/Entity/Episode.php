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
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var Season
     * @ORM\OneToMany(targetEntity="Season", mappedBy="nb_seasons")
     * @ORM\Column(type="integer")
     */
    private $nb_episodes;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Episode
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Episode
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Season
     */
    public function getNbEpisodes(): Season
    {
        return $this->nb_episodes;
    }

    /**
     * @param Season $nb_episodes
     * @return Episode
     */
    public function setNbEpisodes(Season $nb_episodes): Episode
    {
        $this->nb_episodes = $nb_episodes;
        return $this;
    }

}
