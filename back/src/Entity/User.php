<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
// applique la logique de mapping via l'annotation @ORM
// qui correspond à un dossier "Mapping" de Doctrine
// DOC : https://symfony.com/doc/current/doctrine.html
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

// avec @ORM ma class est maintenant une entité
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email que vous avez indiqué est déjà utilisé !")
 * @UniqueEntity(
 * fields={"name", "surname"},
 * message="Identité déja prise")
 */
class User implements UserInterface
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   * @Groups({"create_user", "read_user"})
   */
  private $id;

 /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * @Groups({"create_user", "user_page"})
     * @Assert\NotBlank
     * @Assert\Email
     */
  private $email;

  /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"create_user", "new_annonce", "user_page"})
     * @Assert\NotBlank
     */
  private $name;

 /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"create_user", "new_annonce", "user_page"})
     * @Assert\NotBlank
     */
  private $surname;

  /**
     * @ORM\Column(type="string", length=255)
     * 
     * Minimum 8 charactères, une majuscule, un chiffre et un caractère spécial.
     * @Assert\Regex("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&-\/])[A-Za-z\d@$!%*#?&-\/]{8,}$/", message="Minimum 8 charactères, une majuscule, un chiffre et un caractère spécial.")
     * @Assert\NotCompromisedPassword
     * @Assert\NotBlank
     */
  private $password;

  /**
   * @ORM\Column(type="json")
   */
  private $roles = [];

  /**
     * @ORM\Column(type="datetime")
     * @Groups({"create_user", "user_page"})
     */
  private $created_at;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $updated_at;

  /**
  * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="user", orphanRemoval=true)
  * @Groups("user_page")
  */
  private $annonces;

  public function __toString()
    {
      return $this->surname;
      return $this->name;
    }

  public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }


  public function getId(): ?int
  {
    return $this->id;
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

  public function getname(): ?string
  {
    return $this->name;
  }

  public function setname(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getsurname(): ?string
  {
    return $this->surname;
  }

  public function setsurname(string $surname): self
  {
    $this->surname = $surname;

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

  public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->created_at;
  }

  /**
   * Undocumented function
   * @ORM\PrePersist
   * @return self
   */
  public function setCreatedAt(): self
  {
    $this->created_at = new DateTime();

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updated_at;
  }

  public function setUpdatedAt(?\DateTimeInterface $updated_at): self
  {
    $this->updated_at = $updated_at;

    return $this;
  }

  /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setUser($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }

  /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

     /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER

        // On a pas besoin de ça,
        // si on s'assure que nos users ont au omins 1 rôle associé
        //$roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

}
