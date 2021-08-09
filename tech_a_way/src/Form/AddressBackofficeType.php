<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Length;

class AddressBackofficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $address = $event->getData();
            $form = $event->getForm();
    
                if($address->getType() === 'Livraison choisie') {
            $form->add('delivery', ChoiceType::class, [
                'placeholder' => 'Choisissez',
                'choices' => [
                    'Colissimo' => 'Colissimo',
                    'Chronopost' => 'Chronopost',
                    'Relais_colis' =>'Relais colis'],
                ]);
            }
            

        })

            ->add('type', ChoiceType::class, [
            'choices' => [
                'non défini' => 'Secondaire',
                'Livraison' => 'Livraison',
                'Facturation' => 'Facturation'],
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue'
            ])
            ->add('zipcode', null, [
                'label' => 'Code postal',
                'constraints' =>[new Length([
                    'min' => 5,
                    'minMessage' => 'pas assez de chiffres',
                    // max length allowed by Symfony for security reasons
                    'max' => 5,
                    'maxMessage' => 'trop de chiffres',
                ])],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ]);
 
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
