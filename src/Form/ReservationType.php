<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name')
        ->add('guest')
        ->add('date', DateType::class, [
            'widget' => 'single_text',
            'attr' => [
                'min' => (new \DateTime())->format('Y-m-d'),
                'max' => (new \DateTime('+1 month'))->format('Y-m-d')
            ],
            'html5' => true,
            'required' => true,
        ])
        ->add('hour', ChoiceType::class, [
            'choices' => $this->getHourChoices(),
            'multiple' => false,
            'expanded' => true,
            'required' => true,
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-reservation mt-4'
            ],
            'label' => 'Reserver'
        ]);
}

public function getHourChoices(): array
{
    $start_time = new \DateTime('18:00');
    $end_time = new \DateTime('21:00');
    $interval = new \DateInterval('PT15M');
    $current_time = clone $start_time;

    $choices = [];
    while ($current_time <= $end_time) {
        $choices[$current_time->format('H:i')] = $current_time->format('H:i');
        $current_time->add($interval);
    }

    return $choices;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
