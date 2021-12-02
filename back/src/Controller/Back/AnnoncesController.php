<?php

namespace App\Controller\Back;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Request;
//use App\Form\AnnonceType; //! on peux créer des formulaires avec symfony
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/*AbstractController accède au méthode d'assistance: https://symfony.com/doc/current/controller.html#the-base-controller-class-services
Pour avoir accès à  des méthodes commme $this->render(): https://symfony.com/doc/current/controller.html#controller-rendering-templates */

class AnnoncesController extends AbstractController
{
  /**
   * @Route("/", name="back_annonce_list", methods={"GET"})
   */
  public function list(AnnonceRepository $annonceRepository): Response
  {
    return $this->render('back/annonce/list.html.twig', [
      'annonces' => $annonceRepository->findAll(),
    ]);
  }

  /**
   * @Route("/create", name="back_annonces_create", methods={"GET","POST"})
   */
  public function create(Request $request): Response
  {
    $annonce = new Annonce();
    $form = $this->createForm(AnnonceType::class, $annonce);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($annonce);
      $entityManager->flush();

      return $this->redirectToRoute('back_annonce_list', [], Response::HTTP_SEE_OTHER);
  }

  return $this->renderForm('back/annonce/create.html.twig', [
      'annonce' => $annonce,
      'form' => $form,
  ]);
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
