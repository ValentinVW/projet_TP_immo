<?php

namespace App\Normalizer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Entity normalizer
 */
class EntityNormalizer implements DenormalizerInterface //!  pour la dénormalisation (tableau vers objet)
{
    /** @var EntityManagerInterface **/
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return strpos($type, 'App\\Entity\\') === 0 && (is_numeric($data));
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->em->find($class, $data);
    }
}
//! ENQUETE
//! Sérializer : https://symfony.com/doc/current/components/serializer.html , comment utiliser : https://symfony.com/doc/current/serializer.html
/**
 * Transforme des objets dans un format spécifique
 * Serializer dans controller api car il reçoit les données ainsi que les méthodes les classes qui ont besoin de recevoir des données (en json dans notre cas)
 * 
 */
