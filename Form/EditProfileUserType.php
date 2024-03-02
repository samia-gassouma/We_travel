<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProfileUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('Nom')
            ->add('prenom')
            ->add('Phone_Number')
            ->add('Pays', ChoiceType::class, [
                'label' => 'Pays',
                'choices' => [
                    '' => '',
                    'Tunisie' => 'Tunisie',
                    'France' => 'France',
                    'Germany' => 'Germany',
                    'United States' => 'United States',
            ]])
            ->add('description_user')
            ->add('image_name',FileType::class,[
                'required' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
