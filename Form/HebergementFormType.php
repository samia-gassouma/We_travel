<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;






class HebergementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('voyage_id')
            ->add('nomH',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'nom est obligatoire',

                    ]),
                ],
            ])
            ->add('type',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'type est obligatoire',

                    ]),
                ],
            ])
            ->add('qualite',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'qualité est obligatoire',

                    ]),
                ],
            ])
            ->add('nombre_chambre',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'nombre de chambres est obligatoire',

                    ]),
                ],
            ])
            ->add('liste_activite',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'liste des activités est obligatoire',

                    ]),
                ],
            ])
            ->add('prix',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'prix est obligatoire',

                    ]),
                ],
            ])
            
            ->add('imageFile', VichImageType::class, [
                'label' => 'image_hotel', // Optional: Customize the label
                'required' => false, // Whether the field is required or not
                'asset_helper' => true, // Whether to use the asset helper to display the image
                // You can also add constraints here if needed
            ])
          
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
        ]);
    }
}