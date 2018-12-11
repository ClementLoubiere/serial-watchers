<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="Season")
     */
    private $id;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Episode", mappedBy="Season")
     */
    private $serieId;
    
    public function __construct()
    {
        $this->serieId = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @return Collection
     */
    public function getSerieId(): Collection
    {
        return $this->serieId;
    }
    
    /**
     * @param Collection $serieId
     * @return Season
     */
    public function setSerieId(Collection $serieId): Season
    {
        $this->serieId = $serieId;
        return $this;
    }
    
    

}
