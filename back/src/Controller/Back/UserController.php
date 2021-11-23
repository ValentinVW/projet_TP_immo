<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class UserController extends AbstractController
{
  /**
  * @Route("/", name="back_user_list", methods={"GET"})
  */
  public function list(): Response
  {

  }

  /**
  * @Route("/create", name="back_user_create", methods={"GET", "POST"})
  */
  public function create(): Response
  {
    
  }

  /**
  * @Route("/update/{id<\d+>}", name="back_user_update", methods={"GET","POST"})
  */
  public function update(): Response
  {
    
  }

  /**
  * @Route("/delete/{id<\d+>}", name="back_user_delete", methods={"POST"})
  */
  public function delete(): Response
  {
    
  }
}