<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Enter last name here ...'
                ],
                'label_attr' => [
                    'class' => 'input-label',
                    'for' => 'lastName'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 1,
                        'max' => 255
                    ]),
                ]
            ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Enter first name here ...'
                ],
                'label_attr' => [
                    'class' => 'input-label',
                    'for' => 'firstName'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 1,
                        'max' => 255
                    ]),
                ]
            ])
            ->add('number', TextType::class, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Enter contact number here ...'
                ],
                'label_attr' => [
                    'class' => 'input-label',
                    'for' => 'number'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 1,
                        'max' => 15
                    ]),
                ]
            ])
            ->add('type', EntityType::class, [
                'attr' => [
                    'class' => 'input',
                ],
                'label_attr' => [
                    'class' => 'input-label',
                    'for' => 'type'
                ],
                'class' => Type::class,
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank(),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
