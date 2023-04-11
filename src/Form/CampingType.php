<?php

namespace App\Form;

use App\Entity\Camping;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CampingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('periode')
            ->add('prix')
            ->add('description')
            ->add('imagec', FileType::class, [
                'label' => 'Image du camping',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG or GIF)',
                    ])
                ],
            ])   
        
            ->add('nbr_place')
            ->add('lieux', ChoiceType::class, [
                'choices' => [
                    'Bizerte' => 'Bizerte',
                    'AinDrahem' => 'AinDrahem',
                    'Nabeul' => 'Nabeul',
                    'Beja' => 'Beja',
                    'Klibia' => 'Klibia',
                    'Touzer' => 'Touzer',
                    'Gafsa' => 'Gafsa',
                    'Mahdia' => 'Mahdia',
                    'Haouaria' => 'Haouaria',
                    'Tabarka' => 'Tabarka',
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camping::class,
        ]);
    }
}
