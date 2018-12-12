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
         */
        private $id;
    
        /**
         * @ORM\Column(type="string", length=255)
         * @ORM\JoinColumn(nullable=false)
         */
        private $id_api;

        /**
         * @ORM\OneToMany(targetEntity="App\Entity\Episode", mappedBy="nb_episodes")
         */
        private $episodes;

        /**
         * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="series")
         */
        private $users;
    
        /**
         * Serie constructor.
         * @param $users
         */
        public function __construct($users)
        {
            $this->users = $users;
        }
    
    
        public function getId(): ?int
        {
            return $this->id;
        }
    
        public function getIdApi(): ?string
        {
            return $this->id_api;
        }
    
        public function setIdApi(string $id_api): self
        {
            $this->id_api = $id_api;
        
            return $this;
        }
    
        public function getUsers(): Collection
        {
            return $this->users;
        }
    
        public function setUsers(Collection $users): Serie
        {
            $this->users = $users;
        
            return $this;
        }
        

        /**
         * @return Collection|Episode[]
         */
        public function getEpisodes(): Collection
        {
            return $this->episodes;
        }

        public function addEpisode(Episode $episode): self
        {
            if (!$this->episodes->contains($episode)) {
                $this->episodes[] = $episode;
                $episode->setNbEpisodes($this);
            }

            return $this;
        }

        public function removeEpisode(Episode $episode): self
        {
            if ($this->episodes->contains($episode)) {
                $this->episodes->removeElement($episode);
                // set the owning side to null (unless already changed)
                if ($episode->getNbEpisodes() === $this) {
                    $episode->setNbEpisodes(null);
                }
            }

            return $this;
        }
}
