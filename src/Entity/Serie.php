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
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $genre;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_diff;

    /**
     * @ORM\Column(type="string")
     */
    private $network;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;


    public function getId(): ?int
    {
        return $this->id;
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
    public function getDateDiff()
    {
        return $this->date_diff;
    }

    /**
     * @param mixed $date_diff
     * @return Serie
     */
    public function setDateDiff($date_diff)
    {
        $this->date_diff = $date_diff;
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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return Serie
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
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


}
