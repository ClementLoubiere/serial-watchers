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
     * @ORM\ManyToOne(targetEntity="App\Entity\Serie", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nb_episodes;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbEpisodes(): ?Serie
    {
        return $this->nb_episodes;
    }

    public function setNbEpisodes(?Serie $nb_episodes): self
    {
        $this->nb_episodes = $nb_episodes;

        return $this;
    }


    

}
