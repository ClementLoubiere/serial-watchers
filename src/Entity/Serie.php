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
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(max="50", maxMessage="Le nom ne doit pas faire plus de {{limit}} caractères")


    /**
     * @ORM\Column(type="string)
     */
    private $name;



    /**
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return Serie
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
}
