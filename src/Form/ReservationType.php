<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '1',
                'maxlength' => '100',
            ],
            'label' => 'Nom',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min'  =>  0, 'max' => 100])
            ]
        ])
        ->add('guest', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1,
                'max' => 100,
            ],
            'label' => 'Nombre d\'invités',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Range(['min'  =>  1, 'max' => 100])
            ]
        ])
        ->add('date', DateType::class, [
            'widget' => 'single_text',
            'attr' => [
                'min' => (new \DateTime())->format('Y-m-d'),
                'max' => (new \DateTime('+1 month'))->format('Y-m-d'),
                'class' => 'form-control'
            ],
            'html5' => true,
            'required' => true,
            'label' => 'Date',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
        ])
        ->add('hour', TimeType::class, [
            'widget' => 'choice',
            'hours' => array_merge(range(18, 21), range(18, 21)),
            'minutes' => range(0, 45, 15),
            'html5' => true,
            'placeholder' => [
                'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Second',
            ],
            'required' => true,
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Heure',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ],
            'label' => 'Réserver'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
