<?php
    
    namespace App\Entity;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\Common\Collections\Collection;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
         * @ORM\Column(type="string", length=255)
         * @ORM\JoinColumn(nullable=false)
         */
        private $idApi;

        /**
         * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="series")
         * @ORM\JoinColumn(nullable=false)
         */
        private $user;
    
        
        public function __construct()
        {
            $this->user = new ArrayCollection();
        }
        
    
    
        public function getId(): ?int
        {
            return $this->id;
        }
    
        public function getIdApi(): ?string
        {
            return $this->idApi;
        }
    
        public function setIdApi(string $idApi): self
        {
            $this->idApi = $idApi;
        
            return $this;
        }

        public function getUser(): ?User
        {
            return $this->user;
        }

        public function setUser(?User $user): self
        {
            $this->user = $user;

            return $this;
        }
        
        
    
        public function __toString()
        {
            return $this->idApi;
        }
}
