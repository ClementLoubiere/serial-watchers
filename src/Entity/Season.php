<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use mysql_xdevapi\Collection;


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
     * @var Collection
     * @ORM\M(targetEntity="e", mappedBy="season")
     * @ORM\JoinColumn(nullable=false)
     */
    private $episode;

    /**
     * @return Collection
     */
    public function getEpisode(): Collection
    {
        return $this->episode;
    }

    /**
     * @param Collection $episode
     * @return Season
     */
    public function setEpisode(Collection $episode): Season
    {
        $this->episode = $episode;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
}
