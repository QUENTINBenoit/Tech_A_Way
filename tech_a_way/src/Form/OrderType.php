<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Brand;
use App\Entity\ModeOfPayment;
use App\Entity\Order;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $label = $options['label'];
        // dd($label);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($label) {
            $form = $event->getForm();

            //dd($label['delivery']);
            if(isset($label['delivery'])){
                if($label['delivery'] == 'Colissimo'){
                    $form->add('typeDelivery', ChoiceType::class, [
                        'label' => 'Type de livraison ',
                        'choices' => [
                            'Colissimo' => 'Colissimo',
                            'Chronopost' => 'Chronopost',
                            'Relais colis' => 'Relais colis',
                    ]]);
                }
                else if($label['delivery'] == 'Chronopost'){
                    $form->add('typeDelivery', ChoiceType::class, [
                        'label' => 'Type de livraison ',
                        'choices' => [
                            'Chronopost' => 'Chronopost',
                            'Relais colis' => 'Relais colis',
                            'Colissimo' => 'Colissimo',
                    ]]);
                }
                else if($label['delivery'] == 'Relais colis'){
                    $form->add('typeDelivery', ChoiceType::class, [
                        'label' => 'Type de livraison ',
                        'choices' => [
                            'Relais colis' => 'Relais colis',
                            'Colissimo' => 'Colissimo',
                            'Chronopost' => 'Chronopost',
                    ]]);
                }
                else {
                    $form->add('typeDelivery', ChoiceType::class, [
                    'label' => 'Type de livraison ',
                    'placeholder' => 'Choisissez',
                    'choices' => [
                        'Colissimo' => 'Colissimo',
                        'Chronopost' => 'Chronopost',
                        'Relais colis' => 'Relais colis',
                ]]);
                }

            } else {
                $form->add('typeDelivery', ChoiceType::class, [
                'label' => 'Type de livraison ',
                'placeholder' => 'Choisissez',
                'choices' => [
                    'Colissimo' => 'Colissimo',
                    'Chronopost' => 'Chronopost',
                    'Relais colis' => 'Relais colis',
            ]]);


            }


        })


            // ->add('streetDelivery')
            // ->add('zipcodeDelivery')
            // ->add('cityDelivery')
            // ->add('streetBill')
            // ->add('zipcodeBill')
            // ->add('cityBill')

            ->add('modeOfPayment', EntityType::class, [
                'label' => 'Mode de paiement',
                'placeholder' => 'Choisissez',
                'class' => ModeOfPayment::class,
                'choice_label' => 'type'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
