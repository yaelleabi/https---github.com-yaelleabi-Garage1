<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', null, [
                'label' => 'Sujet',
                'translation_domain' => false, 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le sujet de votre message'
                    ])
                ]
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
                'translation_domain' => false, 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre prénom'
                    ])
                ]
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
                'translation_domain' => false, 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre nom'
                    ])
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email',
                'translation_domain' => false, 
                'help' => 'Nous ne partagerons jamais votre email avec qui que ce soit.',
                'help_attr' => [
                    'class' => 'text-muted small fst-italic fw-lighter'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre email'
                    ]),
                    new Email([
                        'message' => 'Veuillez renseigner un email valide'
                    ])
                ],
            ])
            ->add('phone', null, [
                'label' => 'Téléphone',
                'translation_domain' => false, 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre téléphone'
                    ]),
                    new Regex([
                        'pattern' => '/^0[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Veuillez renseigner un numéro de téléphone valide'
                    ])
                ]
            ])
            ->add('description', null, [
                'label' => 'Description',
                'translation_domain' => false,
                'attr' => [
                    'rows' => 3
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre message'
                    ])
                ]
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Envoyer',
                'translation_domain' => false,
                'attr' => [
                    'type' => 'submit',
                    'class' => 'btn mt-2 btn-main'
                ],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
