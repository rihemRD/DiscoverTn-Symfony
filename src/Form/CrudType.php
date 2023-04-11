<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CrudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'constraints' => [
                new NotBlank(),
            ],
        ])
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Aeroport' => 'Aeroport',
                'Sortie' => 'Sortie',
                'Randonnee' => 'Randonnee',
            ],
            'placeholder' => 'Choose an option',
        ])
        ->add('lieu', TextType::class, [
            'constraints' => [
                new NotBlank(),
            ],
        ])
        ->add('numtel', TelType::class, [
            'constraints' => [
                new Regex([
                    'pattern' => '/^[0-9]{8}$/',
                    'message' => 'Le numéro de téléphone doit contenir exactement 8 chiffres',
                ]),
            ],
        ])
        ->add('heure', null, [
            'constraints' => [
                new NotBlank(),
                new Regex('/^\d/')
            ]
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
