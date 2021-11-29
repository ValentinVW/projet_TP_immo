<?php

namespace App\Entity;

// applique la logique de mapping via l'annotation @ORM
// qui correspond à un dossier "Mapping" de Doctrine
// DOC : https://symfony.com/doc/current/doctrine.html
use Doctrine\ORM\Mapping as ORM;

// avec @ORM ma class est maintenant une entité
/**
 * @ORM\Entity
 */
class AnnonceController
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
   * @ORM\ManyToOne(targetEntity=User::class)
   * @ORM\JoinColumn(nullable=false)
   */
  private $user;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $name;

  private $image;

  private $type;

  private $adresse;

  /**
   * @ORM\Column(type="number")
   */
  private $prix;

  /**
   * @ORM\Column(type="number", length=10)
   */
  private $m²;

  /**
   * @ORM\Column(type="number", length=8)
   */
  private $piece;

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Assert\Length(max = 300)
   */
  private $content;

  /**
   * @ORM\Column(type="number", length=15)
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

  private $delete_at;
}
