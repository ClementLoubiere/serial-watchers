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
     *
     * @ORM\Column(type="string")
     */
    private $name;


    /**
     * @ORM\Column(type="string")
     *
     */
    private $genre;

    /**
     * @ORM\Column(type="integer")
     */
    private $season;
    /**
     * @ORM\Column(type="string")
     */

    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $episod;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date;


    /***
     * @ORM\Column(type="string")
     */
    private $network;


    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @return User
     */
    public function getProfil(): User
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







    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Serie
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return Serie
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     * @return Serie
     */
    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return Serie
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEpisod()
    {
        return $this->episod;
    }

    /**
     * @param mixed $episod
     * @return Serie
     */
    public function setEpisod($episod)
    {
        $this->episod = $episod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return Serie
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * @param mixed $network
     * @return Serie
     */
    public function setNetwork($network)
    {
        $this->network = $network;
        return $this;
    }






    public function getId(): ?int
    {
        return $this->id;
    }
}
