<?php

namespace App\Form;

use App\Entity\PosteFormulaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PosteFormulaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre:*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom:*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Last Name:*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email:*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe:*',
                'choices' => [
                    'Masculin' => 'M',
                    'Féminin' => 'F',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'js-example-basic-single col-sm-12 form-control'],
            ])
            ->add('phone', TelType::class, [
                'label' => 'Numero de téléphone:',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('cv', FileType::class, [
                'label' => 'Votre CV:*',
                'required' => false, // Allow empty file uploads
                'attr' => [
                    'class' => 'form-control-file',
                    'accept' => '.pdf', // Spécifier les types de fichiers autorisés (.pdf ici)
                ],
            ])
            ->add('lettreMotivation', FileType::class, [
                'label' => 'Votre lettre de motivation:*',
                'required' => false, // Allow empty file uploads
                'attr' => [
                    'class' => 'form-control-file',
                    'accept' => '.pdf', // Spécifier les types de fichiers autorisés (.pdf ici)
                ],
            ])

            ->add('photoIdentite', FileType::class, [
                'label' => 'Votre photo d\'identite:*',
                'required' => false, // Allow empty file uploads
                'attr' => [
                    'class' => 'form-control-file',
                    'accept' => 'image/*', // Spécifier les types d'images autorisés
                ],
            ])
            ->add('photoComplete', FileType::class, [
                'label' => 'Votre Photo Compléte:*',
                'required' => false, // Allow empty file uploads
                'attr' => [
                    'class' => 'form-control-file',
                    'accept' => 'image/*', // Spécifier les types d'images autorisés
                ],
            ])
         
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Soumettre ma demande'
            ]);

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PosteFormulaire::class,
        ]);
    }
}
