<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="User" )
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_serie_api;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Season", mappedBy="Serie")
     */
    private $serie;
    
    
    public function __construct()
    {
        $this->serie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
    
    /**
     * @return Collection
     */
    public function getSerie(): Collection
    {
        return $this->serie;
    }
    
    /**
     * @param Collection $serie
     * @return Serie
     */
    public function setSerie(Collection $serie): Serie
    {
        $this->serie = $serie;
        return $this;
    }
    
    


}
