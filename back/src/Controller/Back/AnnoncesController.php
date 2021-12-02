<?php

namespace App\Controller\Back;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AnnonceType; //! on peux créer des formulaires avec symfony
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
   * @Route("/create", name="back_annonce_create", methods={"GET","POST"})
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
     * @Route("/read/{id<\d+>}", name="back_annonce_read", methods={"GET"})
     */
    public function read(Annonce $annonce = null): Response
    {   
        // On vérifie que le Comment existe bien
        if (null === $annonce) {

            $error = 'Cette annonce n\'existe pas';

            return $this->json(['error' => $error], Response::HTTP_NOT_FOUND);
        }

        return $this->render('back/annonce/read.html.twig', [
            'annonce' => $annonce,
        ]);
    }

  /**
   * @Route("/update/{id<\d+>}", name="back_annonce_update", methods={"GET","POST"})
   */
  public function update(Request $request, Annonce $annonce = null): Response
  {
     // On vérifie que le Comment existe bien
     if (null === $annonce) {

      $error = 'Cette annonce n\'existe pas';

      return $this->json(['error' => $error], Response::HTTP_NOT_FOUND);
  }
  
  $form = $this->createForm(AnnonceType::class, $annonce);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('back_annonce_list', [], Response::HTTP_SEE_OTHER);
  }

  return $this->renderForm('back/annonce/update.html.twig', [
      'annonce' => $annonce,
      'form' => $form,
  ]);
  }

  /**
   * @Route("/delete/{id<\d+>}", name="back_annonce_delete", methods={"POST"})
   */
  public function delete(Request $request, Annonce $annonce = null, EntityManagerInterface $em): Response
    {
        // On vérifie que le Comment existe bien
        if (null === $annonce) {

            $error = 'Ce commentaire n\'existe pas';

            return $this->json(['error' => $error], Response::HTTP_NOT_FOUND);
        }
        
        // if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
        //     $em->remove($user);
        //     $em->flush();
        // }
                
        // Il existe bien, donc on envoie la demande de suppression
        $em->remove($annonce);
        $em->flush();
        
        return $this->redirectToRoute('back_annonce_list', [], Response::HTTP_SEE_OTHER);
    }
}
