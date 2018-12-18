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
     * @ORM\Column(type="string", length=255)
     */
    private $idEpisode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserEp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEpisode(): ?string
    {
        return $this->idEpisode;
    }

    public function setIdEpisode(string $idEpisode): self
    {
        $this->idEpisode = $idEpisode;

        return $this;
    }

    public function getUserEp(): ?User
    {
        return $this->UserEp;
    }

    public function setUserEp(?User $UserEp): self
    {
        $this->UserEp = $UserEp;

        return $this;
    }

}