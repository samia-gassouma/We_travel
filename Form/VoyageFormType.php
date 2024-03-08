<?php

namespace App\Form;

use App\Entity\Voyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;





class VoyageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destination',null,[
                'required'=> false, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'destination est obligatoire',

                    ]),
                ],
            ])

            ->add('imageFile', VichImageType::class, [
                'label' => 'image_hotel', // Optional: Customize the label
                'required' => false, // Whether the field is required or not
                'asset_helper' => true, // Whether to use the asset helper to display the image
                // You can also add constraints here if needed
            ])
           
            ->add('submit',SubmitType::class)
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
