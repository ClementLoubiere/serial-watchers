<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * Assert\NotBlank("message="Le pseudo est obligatoire")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=45)
     * Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=45)
     * Assert\NotBlank("message="Le prénom est obligatoire")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     * Assert\NotBlank("message="L'adresse email est obligatoire")
     * @Assert\Email("L'email n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $password;
    /**
     * @ORM\colum,(type="string",length=20)
     */
    private $role= 'ROLE_USER';
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
    private $status;

    /**
     * @var profil
     */
    private $profil;

    /**
     * @return profil
     */
    public function getProfil(): profil
    {
        return $this->profil;
    }

    /**
     * @param profil $profil
     * @return User
     */
    public function setProfil(profil $profil): User
    {
        $this->profil = $profil;
        return $this;
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
}
