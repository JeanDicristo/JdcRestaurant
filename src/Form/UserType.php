<?php

namespace App\Form;

use App\Entity\ProfilUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '0',
                'maxlenght' => '255'
            ],
            'label' => 'Adresse email',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Length(['min'  =>  2, 'max' => 255])
            ]
        ])
        ->add('Guest', IntegerType::class,  [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Nombre de convives',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\PositiveOrZero(),
                new Assert\Length(['min'  =>  0, 'max' => 255])
            ]
        ])
        ->add('plainPassword', PasswordType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Mot de passe',
            'label_attr' => [
                'class' => 'form-label  mt-4'
            ]
        ])

        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn button-connexion mt-4'
            ],
            'label' => 'Modifier'
        ]) ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfilUser::class,
        ]);
    }
}
