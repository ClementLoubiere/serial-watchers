<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * id de la table serie
     */
    private $id;

    /**
     *
     * @ORM\Column(type="integer")
     * id de la serie de l'api
     */
    private $idApiSerie;

    /**
     * @var Season
     * @ORM\OneToMany(targetEntity="Season", mappedBy="oneSerie")
     * liste des saisons
     */
    private $listSeasons;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="User", inversedBy="series")
     * plusieurs series pour n utilisateurs
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdApiSerie()
    {
        return $this->idApiSerie;
    }


    public function setIdApiSerie($idApiSerie)
    {
        $this->idApiSerie = $idApiSerie;
        return $this;
    }

    /**
     * @return Season
     */
    public function getListSeasons(): Season
    {
        return $this->listSeasons;
    }

    /**
     * @param Season $listSeasons
     * @return Serie
     */
    public function setListSeasons(Season $listSeasons): Serie
    {
        $this->listSeasons = $listSeasons;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param Collection $users
     * @return Serie
     */
    public function setUsers(Collection $users): Serie
    {
        $this->users = $users;
        return $this;
    }

    public function __toString()
    {
        $this->idApiSerie;
    }


}
