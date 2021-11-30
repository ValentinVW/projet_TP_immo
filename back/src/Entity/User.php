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
use Symfony\Component\Security\Core\User\UserInterface;

// avec @ORM ma class est maintenant une entité
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   * //@Groups({"create_user", "read_user"})
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $email;

  /**
   * @ORM\Column(type="string", length=100)
   */
  private $name;

  /**
   * @ORM\Column(type="string", length=100)
   */
  private $surname;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $password;

  /**
   * @ORM\Column(type="json")
   */
  private $roles = [];

  /**
   * @ORM\Column(type="datetime")
   * //@Groups({"create_user", "user_page"})
   */
  private $created_at;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $updated_at;

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

  public function getRoles(): ?array
  {
      return $this->roles;
  }

  public function setRoles(array $roles): self
  {
      $this->roles = $roles;

      return $this;
  }
}
