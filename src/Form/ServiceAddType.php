<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ServiceAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                "label" => "Nom du service",
                "required" => true,
                'translation_domain' => false,
                "constraints" => [
                    new NotBlank(
                        [
                            'message' => 'Veuillez saisir un nom de service',
                        ]
                    ),
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'Le nom du service doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom du service ne doit pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('description', null, [
                "label" => "Description du service",
                "required" => true,
                'translation_domain' => false,
                "constraints" => [
                    new NotBlank(
                        [
                            'message' => 'Veuillez saisir une description de service',
                        ]
                    ),
                ],
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Continuer',
                'translation_domain' => false,
                'attr' => [
                    'type' => 'submit',
                    'class' => 'btn mt-2 btn-main'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
