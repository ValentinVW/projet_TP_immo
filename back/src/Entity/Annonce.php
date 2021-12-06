<?php

namespace App\Entity;

use DateTime;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
// applique la logique de mapping via l'annotation @ORM
// qui correspond à un dossier "Mapping" de Doctrine
// DOC : https://symfony.com/doc/current/doctrine.html


// avec @ORM ma class est maintenant une entité
/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Annonce
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=100)
   */

 /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"new_annonce"})
     * @Assert\NotBlank
     */
  private $user;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $name;

   /**
   * @ORM\Column(type="string")
   */
  private $image;

  private $type;

  /**
   * @ORM\Column(type="string", length=200)
   */
  private $adresse;

  /**
   * @ORM\Column(type="decimal", length=9)
   */
  private $prix;

  /**
   * @ORM\Column(type="decimal", length=9)
   */
  private $m²;

  /**
   * @ORM\Column(type="decimal", length=8)
   */
  private $piece;

  /**
   * @ORM\Column(type="string")
   */
  private $content;

  /**
   * @ORM\Column(type="decimal", length=15)
   */
  private $contactnumber;

  /**
   * @ORM\Column(type="datetime")
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

  public function getUser(): ?User
  {
    return $this->user;
  }

  public function setUser(?User $user): self
  {
    $this->user = $user;

    return $this;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getImage()
  {
    return $this->image;
  }

  /**
   * Set the value of image
   *
   * @return  self
   */ 
  public function setImage($image)
  {
    $this->image = $image;

    return $this;
  }

  public function getType()
  {
    return $this->type;
  }

  /**
   * Set the value of type
   *
   * @return  self
   */ 
  public function setType($type)
  {
    $this->type = $type;

    return $this;
  }

  public function getAdresse()
  {
    return $this->adresse;
  }

  /**
   * Set the value of adresse
   *
   * @return  self
   */ 
  public function setAdresse($adresse)
  {
    $this->adresse = $adresse;

    return $this;
  }

  public function getPrix()
  {
    return $this->prix;
  }

  /**
   * Set the value of prix
   *
   * @return  self
   */ 
  public function setPrix($prix)
  {
    $this->prix = $prix;

    return $this;
  }

  public function getM²()
  {
    return $this->m²;
  }

  /**
   * Set the value of m²
   *
   * @return  self
   */ 
  public function setM²($m²)
  {
    $this->m² = $m²;

    return $this;
  }

  public function getPiece()
  {
    return $this->piece;
  }

  /**
   * Set the value of piece
   *
   * @return  self
   */ 
  public function setPiece($piece)
  {
    $this->piece = $piece;

    return $this;
  }

  public function getContent()
  {
    return $this->content;
  }

  /**
   * Set the value of content
   *
   * @return  self
   */ 
  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

  public function getContactnumber()
  {
    return $this->contactnumber;
  }

  /**
   * Set the value of contactnumber
   *
   * @return  self
   */ 
  public function setContactnumber($contactnumber)
  {
    $this->contactnumber = $contactnumber;

    return $this;
  }

  public function getCreated_at()
  {
    return $this->created_at;
  }

  /**
   * Set the value of created_at
   *
   * @return  self
   */ 
  public function setCreated_at(DateTime $created_at)
  {
    $this->created_at = $created_at;

    return $this;
  }

  public function getUpdated_at()
  {
    return $this->updated_at;
  }

  /**
   * Set the value of updated_at
   *
   * @return  self
   */ 
  public function setUpdated_at(DateTime $updated_at)
  {
    $this->updated_at = $updated_at;

    return $this;
  }


  public function getCreatedAt(): ?\DateTimeInterface
  {
      return $this->created_at;
  }

  public function setCreatedAt(\DateTimeInterface $created_at): self
  {
      $this->created_at = $created_at;

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
}
