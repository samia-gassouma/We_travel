<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('contenu', TextareaType::class,array(
            'label' => 'Contenu ',
            'attr' => array(
                'placeholder' => 'Votre message',
                'rows' => 5
            )
       ) )
            ->add('etat')
            ->add('reclamation', EntityType::class, [
                'class' => Reclamation::class,
                'label' => 'reclamation',
                //'placeholder' => 'Please select reservation',
                //'choice_label' => 'id',
                //'query_builder' => function (ReclamationRepository $rR) {
                    // Customize the query to retrieve only one record (e.g., the latest or a specific one)
                    //return $rR->createQueryBuilder('r')
                       // ->setMaxResults(1); // Adjust as needed
               // },
                //'attr' => [
                       // 'class' => 'dynamic-field1', // Add a class for easier JavaScript targeting]
                ])
            ->add('send',SubmitType::class,array(
                'label' => 'Send'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}
