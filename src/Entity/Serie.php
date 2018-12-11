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


}
