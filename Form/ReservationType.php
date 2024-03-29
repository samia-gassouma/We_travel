<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('numberOfPersons')
            ->add('dateFrom', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'flatpickr'],
            ])
            ->add('dateTo', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'flatpickr'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
