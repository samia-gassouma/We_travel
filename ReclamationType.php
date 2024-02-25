<?php

namespace App\Form;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Reclamation;
use App\Entity\Reservation;
use App\Entity\Paiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;



class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',ChoiceType::class, [
                'placeholder' => 'select',
                'choices' => [
                    'reservation' => 'reservation',
                    'paiement' => 'paiement'],
                'attr' => [
                    'class' => 'choice-field', // Add a class for easier JavaScript targeting
                    ],
                'required' =>false
                ])
                    
            ->add('reservation', EntityType::class, [
                    'class' => Reservation::class,
                    'label' => 'reservation',
                    'placeholder' => 'Please select reservation',
                    //'choice_label' => 'id',
                    'attr' => [
                            'class' => 'dynamic-field1', // Add a class for easier JavaScript targeting
                    ],
                    'required' =>false])
            ->add('paiement', EntityType::class, [
                    'class' => Paiement::class,
                    'label' => 'paiment',
                    'placeholder' => 'Please select paiement',
                    //'choice_label' => 'id',
                     'attr' => [
                            'class' => 'dynamic-field2', // Add a class for easier JavaScript targeting
                     ],
                    'required' =>false
                    ])          
            ->add('date', DateTimeType::class,[
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'empty_data' => '',
                    'required' =>false    ])

            ->add('description', TextareaType::class,array(
                'label' => 'Description ',
                'attr' => array(
                    'placeholder' => 'Votre message',
                    'rows' => 5
                ),
                'required' =>false
                )
           )
           ->add('send',SubmitType::class,array(
            'label' => 'Envoyer'))
            ->add('save',SubmitType::class,array(
                'label' => 'Enregistrer les modifications'))
            ->add("recaptcha", ReCaptchaType::class)
           ->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmit']);
           
           //->add('captcha', Recaptcha3Type::class, [
            //'constraints' => new Recaptcha3(),
            //'action_name' => 'reclamation',
            //'script_nonce_csp' => $nonceCSP,
           // 'locale' => 'de',
       // ]);

            
           

                   // $builder->add('paiement', EntityType::class, [
                     //   'class' => Paiement::class,
                        //'choice_label' => 'paie',
                    //]);
          
            // Check the value of yourChoiceField and modify the form accordingly
        
            }

    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        // Check the selected choice and modify the form accordingly
        if (isset($data['type']) && $data['type'] === 'reservation') {
            $data['paiement']=null;
        }
        else{
            $data['reservation']=null;
        }
       // $data['date']=$data['date']->format('Y-m-d H:i:s');
        $event->setData($data);
    }
        

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
            'csrf_protection' => false,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'task_item',
        ]);
    }
}
