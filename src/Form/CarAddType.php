<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class CarAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', null, [
                'label' => 'Marque',
                'translation_domain' => false,
            ])
            ->add('model', null, [
                'label' => 'Modèle',
                'translation_domain' => false,
            ])
            ->add('year', NumberType::class, [
                'label' => 'Année de mise en circulation',
                'translation_domain' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une année',
                    ]),
                    new GreaterThanOrEqual([
                        'value' => 1900,
                        'message' => 'L\'année doit être supérieure ou égale à 1900',
                    ]),
                ],
            ])
            ->add('km', NumberType::class, [
                'label' => 'Nombre de kilomètres',
                'translation_domain' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nombre de kilomètres',
                    ]),
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Le nombre de kilomètres doit être supérieur ou égal à zéro',
                    ]),
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix (€)',
                'translation_domain' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un prix',
                    ]),
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Le prix doit être supérieur ou égal à zéro',
                    ]),
                ],
                'attr' => [
                    'min' => 0,
                    'step' => 0.01,
                ],
            ])
            ->add('description', null, [
                'required' => false,
                'label' => 'Description',
                'translation_domain' => false,
                
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer l\'image',
                'image_uri' => true,
                'download_uri' => true,
                'download_label' => 'Télécharger l\'image',
                'asset_helper' => true,
                'translation_domain' => false,
                'label' => 'Image de la voiture',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner une image',
                    ]),
                    new \Symfony\Component\Validator\Constraints\File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez sélectionner une image au format jpeg ou png',
                        "maxSizeMessage" => "L'image ne doit pas dépasser 2Mo",
                    ]),
                ],
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Continuer',
                'translation_domain' => false,
                'attr' => [
                    'type' => 'submit',
                    'class' => 'btn mt-2 btn-main'
                ]
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
