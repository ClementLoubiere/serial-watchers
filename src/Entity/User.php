<?php
    namespace App\Entity;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Validator\Constraints as Assert;
    use Doctrine\Common\Collections\Collection;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
     */
    class User implements UserInterface, \Serializable
    {
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        private $id;
        /**
         * @ORM\Column(type="string", length=25)
         * @Assert\NotBlank(message="Le pseudo est obligatoire")
         * @Assert\Length(max="25", maxMessage="Le pseudo ne doit pas dépasser {{ limit }} caractères")
         */
        private $pseudo;
        /**
         * @ORM\Column(type="string", length=45)
         * @Assert\NotBlank(message="Le nom est obligatoire")
         * @Assert\Length(max="45", maxMessage="Le nom ne doit pas faire plus de {{ limit }} caractères")
         */
        private $lastname;
        /**
         * @ORM\Column(type="string", length=45)
         * @Assert\NotBlank(message="Le prénom est obligatoire")
         * @Assert\Length(max="45", maxMessage="Le prénom ne doit pas faire plus de {{ limit }} caractères")
         */
        private $firstname;
        /**
         * @ORM\Column(type="string", length=100)
         * @Assert\NotBlank(message="L'email est obligatoire")
         */
        private $email;
        /**
         * @ORM\Column(type="string", length=255)
         */
        private $password;
        /**
         * @ORM\Column(type="string", length=20)
         */
        private $gender;
        /**
         * @ORM\Column(type="datetime")
         */
        private $birthdate;
        /**
         * @ORM\Column(type="string", length=45)
         */
        private $status = 'ROLE_USER';
        /**
         * Mot de passe pour intéragir avec le formulaire d'inscription
         *
         * @var string
         * @Assert\NotBlank(message="Le mot de passe est obligatoire")
         */
        private $plainPassword;

        /**
         * @ORM\OneToMany(targetEntity="App\Entity\Serie", mappedBy="user")
         */
        private $series;

        public function __construct()
        {
            $this->series = new ArrayCollection();
        }
    
    
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getPseudo(): ?string
        {
            return $this->pseudo;
        }
        public function setPseudo(string $pseudo): self
        {
            $this->pseudo = $pseudo;
            return $this;
        }
        public function getLastname(): ?string
        {
            return $this->lastname;
        }
        public function setLastname(string $lastname): self
        {
            $this->lastname = $lastname;
            return $this;
        }
        public function getFirstname(): ?string
        {
            return $this->firstname;
        }
        public function setFirstname(string $firstname): self
        {
            $this->firstname = $firstname;
            return $this;
        }
        public function getEmail(): ?string
        {
            return $this->email;
        }
        public function setEmail(string $email): self
        {
            $this->email = $email;
            return $this;
        }
        public function getPassword(): ?string
        {
            return $this->password;
        }
        public function setPassword(string $password): self
        {
            $this->password = $password;
            return $this;
        }
        public function getGender(): ?string
        {
            return $this->gender;
        }
        public function setGender(string $gender): self
        {
            $this->gender = $gender;
            return $this;
        }
        public function getBirthdate(): ?\DateTimeInterface
        {
            return $this->birthdate;
        }
        public function setBirthdate(\DateTimeInterface $birthdate): self
        {
            $this->birthdate = $birthdate;
            return $this;
        }
        public function getStatus(): ?string
        {
            return $this->status;
        }
        public function setStatus(string $status): self
        {
            $this->status = $status;
            return $this;
        }
        /**
         * @return string
         */
        public function getPlainpassword(): ?string
        {
            return $this->plainPassword;
        }
        /**
         * @param string $plainpassword
         * @return User
         */
        public function setPlainpassword(string $plainPassword): User
        {
            $this->plainPassword = $plainPassword;
            return $this;
        }

        /**
         * @return Collection|Serie[]
         */
        public function getSeries(): Collection
        {
            return $this->series;
        }

        public function addSeries(Serie $series): self
        {
            if (!$this->series->contains($series)) {
                $this->series[] = $series;
                $series->setUser($this);
            }

            return $this;
        }

        public function removeSeries(Serie $series): self
        {
            if ($this->series->contains($series)) {
                $this->series->removeElement($series);
                // set the owning side to null (unless already changed)
                if ($series->getUser() === $this) {
                    $series->setUser(null);
                }
            }

            return $this;
        }

        /**
         * String representation of object
         * @link https://php.net/manual/en/serializable.serialize.php
         * @return string the string representation of the object or null
         * @since 5.1.0
         */
        public function serialize()
        {
            return serialize([
                $this->id,
                $this->lastname,
                $this->firstname,
                $this->email,
                $this->password,
                $this->gender,
                $this->birthdate
            ]);
        }
        /**
         * Constructs the object
         * @link https://php.net/manual/en/serializable.unserialize.php
         * @param string $serialized <p>
         * The string representation of the object.
         * </p>
         * @return void
         * @since 5.1.0
         */
        public function unserialize($serialized)
        {
            list(
                $this->id,
                $this->lastname,
                $this->firstname,
                $this->email,
                $this->password,
                $this->gender,
                $this->birthdate
                ) = unserialize($serialized);
        }
        /**
         * Returns the roles granted to the user.
         *
         *     public function getRoles()
         *     {
         *         return array('ROLE_USER');
         *     }
         *
         * Alternatively, the roles might be stored on a ``roles`` property,
         * and populated in any number of different ways when the user object
         * is created.
         *
         * @return (Role|string)[] The user roles
         */
        public function getRoles()
        {
            return [$this->status];
        }
        /**
         * Returns the salt that was originally used to encode the password.
         *
         * This can return null if the password was not encoded using a salt.
         *
         * @return string|null The salt
         */
        public function getSalt()
        {
            return null;
        }
        /**
         * Returns the username used to authenticate the user.
         *
         * @return string The username
         */
        public function getUsername()
        {
            // attribut qui va servir d'identifiant
            return $this->email;
        }
        /**
         * Removes sensitive data from the user.
         *
         * This is important if, at any given point, sensitive information like
         * the plain-text password is stored on this object.
         */
        public function eraseCredentials()
        {
            // TODO: Implement eraseCredentials() method.
        }
        public function __toString()
        {
            return $this->pseudo;
        }
    
    }
