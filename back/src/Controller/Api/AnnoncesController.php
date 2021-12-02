<?php

namespace App\Controller\Api;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;



/**
 * @Route("/api/annonce")
 */
class AnnoncesController extends AbstractController
{
   /**
     * Endpoint permettant au Front d'accéder à la liste complète des annonces
     * 
     * @Route("/", name="api_annonce_list", methods="GET")
     */
    public function list(AnnonceRepository $annonceRepository): Response
    {
        // On retourne les objets $annonce en JSON
        return $this->json(['annonces' => $annonceRepository->findAll()], Response::HTTP_OK, [], ['groups' => 'new_annonce']);
    }

    /**
     * Endpoint permettant au Front de créer un annonce
     * 
     * @Route("/create", name="api_annonce_create", methods="POST")
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $vi, Security $security): Response
    {
        // On récupère le contenu de la requête (du JSON)
        $jsonContent = $request->getContent();

        // On désérialise le JSON vers une entité annonce
        $annonce = $serializer->deserialize($jsonContent, Annonce::class, 'json');

        // On récupère le $user à l'aide du Token et on le set
        $user = $security->getUser();
        $annonce->setUser($user);

        // On valide l'entité avec le service Validator
        $errors = $vi->validate($annonce);

        // Si la validation rencontre des erreurs
        if (count($errors) > 0) {
            // On renvoie les différentes erreurs sous forme de tableau
            return $this->json(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // On persist, on flush
        $em->persist($annonce);        
        $em->flush();

        // On retourne l'objet $annonce en JSON
        return $this->json(["message" => "annonce créé", 'annonce' => $annonce], Response::HTTP_CREATED, [], ['groups' => 'new_annonce']);
    }

    /**
     * Endpoint permettant au Front d'afficher un annonce spécifique
     * (Utilisation éventuelle pour un affichage aléatoire d'un annonce sur la page home/scénarios)
     * 
     * @Route("/read/{id<\d+>}", name="api_annonce_read", methods="GET")
     */
    public function read(Annonce $annonce): Response
    {
        // On retourne l'objet $annonce en JSON
        return $this->json(['annonce' => $annonce], Response::HTTP_OK, [], ['groups' => 'new_annonce']);
    }

    /**
     * Endpoint permettant au Front d'éditer une annonce spécifique sur la page Profil
     * 
     * @Route("/update/{id<\d+>}", name="api_annonce_update", methods={"PUT", "PATCH"})
     */
    public function update(Request $request, Annonce $annonce = null, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $vi): Response
    {
        // On vérifie que le annonce existe bien
        if (null === $annonce) {
            return new JsonResponse(
                ["message" => "Cette annonce n'existe pas"],
                Response::HTTP_NOT_FOUND
            );
        }
        
        // On récupère le contenu de la requête (du JSON)
        $jsonContent = $request->getContent();

        // On désérialise le JSON vers l'entité annonce
        $annonce = $serializer->deserialize($jsonContent, Annonce::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $annonce]);

        // On valide l'entité avec le service Validator
        $errors = $vi->validate($annonce);

        // Si la validation rencontre des erreurs
        if (count($errors) > 0) {
            // On renvoie les différentes erreurs sous forme de tableau
            return $this->json(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // On flush
        $em->flush();

        // On retourne l'objet $annonce en JSON
        return $this->json(["message" => "annonce modifié", 'annonce' => $annonce], Response::HTTP_OK, [], ['groups' => 'new_annonce']);
    }

    /**
     * Endpoint permettant au Front de supprimer une annonce spécifique sur la page Profil
     * 
     * @Route("/delete/{id<\d+>}", name="api_annonce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Annonce $annonce = null, EntityManagerInterface $em): Response
    {
        // On vérifie que le annonce existe bien
        if (null === $annonce) {
            return new JsonResponse(
                ["message" => "Cette annonce n'existe pas"],
                Response::HTTP_NOT_FOUND
            );
        }
                
        // Il existe bien, donc on envoie la demande de suppression
        $em->remove($annonce);
        $em->flush();

        // On renvoie l'affirmation de la suppression
        return new JsonResponse(['message' => 'L\' annonce a bien été supprimé.'], Response::HTTP_OK);
    }
}