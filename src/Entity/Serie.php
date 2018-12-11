<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_serie_api;


    public function getId(): ?int
    {
        return $this->id;
    }
    

    /**
     * @return User
     */
    public function getProfil(): ?User
    {
        return $this->profil;
    }

    /**
     * @param User $profil
     * @return Serie
     */
    public function setProfil(User $profil): Serie
    {
        $this->profil = $profil;
        return $this;
    }

    public function getIdSerieApi(): ?string
    {
        return $this->id_serie_api;
    }

    public function setIdSerieApi(string $id_serie_api): self
    {
        $this->id_serie_api = $id_serie_api;

        return $this;
    }


}
