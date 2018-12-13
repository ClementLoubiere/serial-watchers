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
     * id de la table serie
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * id de la serie de l'api
     */
    private $idApiSerie;

    /**
     * @ORM\OneToMany(targetEntity="Season", mappedBy="oneSerie")
     * liste des saisons
     */
    private $listSeasons;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="users")
     * plusieurs series pour n utilisateur
     */
    private $series;

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


    public function getListSeasons()
    {
        return $this->listSeasons;
    }


    public function setListSeasons($listSeasons)
    {
        $this->listSeasons = $listSeasons;
        return $this;
    }


}
