<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AnnoncesController extends AbstractController
{
  /**
  * @Route("/", name="back_annonces_list", methods={"GET"})
  */
  public function list(): Response
  {

  }

  /**
  * @Route("/create", name="back_annonces_create", methods={"GET","POST"})
  */
  public function create(): Response
  {
    
  }

  /**
  * @Route("/update/{id<\d+>}", name="back_annonces_update", methods={"GET","POST"})
  */
  public function update(): Response
  {
    
  }


  /**
  * @Route("/delete/{id<\d+>}", name="back_annonces_delete", methods={"POST"})
  */
  public function delete(): Response
  {
    
  }
}