<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'translation_domain' => false,
                'label' => 'Votre nom',
                'required' => true,
            ])
            ->add('description', null, [
                'translation_domain' => false,
                'label' => 'Votre avis',
                'required' => true,
            ])
            ->add('note', null, [
                'translation_domain' => false,
                'label' => false,
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'd-none'
                ]
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Envoyer',
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
            'data_class' => Review::class,
            'allow_extra_fields' => true,
        ]);
    }
}
