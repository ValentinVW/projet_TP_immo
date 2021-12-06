<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Annonce;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre commentaire',
            ])
            ->add('adresse', TextareaType::class, [
                'label' => 'Votre adresse complète',
            ])
            ->add('image', TextareaType::class, [
                'label' => 'Des images pour illustrer votre annonce de bien',
            ])
            ->add('prix', TextareaType::class, [
                'label' => 'Le prix du bien',
            ])
            ->add('m²', TextareaType::class, [
                'label' => 'Surface du bien',
            ])
            ->add('pieces', TextareaType::class, [
                'label' => 'Nombre de pieces',
            ])
            ->add('contactnumber', TextareaType::class, [
                'label' => 'Numéro de contact',
            ])
            ->add('type de bien', TextareaType::class, [
                'label' => 'Appartement ou maison ?',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (UserRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->orderBy('u.email', 'ASC');
                },
                'label' => 'Sélection de l\'utilisateur',
                'choice_label' => 'email',
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
