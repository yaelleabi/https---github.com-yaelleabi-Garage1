<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'translation_domain' => false,
                'label' => 'Adresse email',
                'required' => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'translation_domain' => false,
                'help' => 'Le mot de passe doit contenir au moins 6 caractères et ne doit pas dépasser 4096 caractères.',
                'label' => 'Mot de passe',
                'required' => true,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank(
                        [
                            'message' => 'Veuillez saisir un mot de passe',
                        ]
                    ),
                    new Length([
                        'min' => 6,
                        'max' => 4096,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le mot de passe ne doit pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('button', SubmitType::class, [
                'label' => 'S\'inscrire',
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
            'data_class' => User::class,
        ]);
    }
}
