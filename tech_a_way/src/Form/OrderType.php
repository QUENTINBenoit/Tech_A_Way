<?php

namespace App\Form;

use App\Entity\Order;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeDelivery', ChoiceType::class, [
                'label' => 'choisissez votre mode de livraison',
                'choices' => [
                    'colissimo' => 'colissimo',
                    'chronopost' => 'chronopost',
                    'relais colis' => 'relais colis',
            ]])
            ->add('streetDelivery')
            ->add('zipcodeDelivery')
            ->add('cityDelivery')
            ->add('streetBill')
            ->add('zipcodeBill')
            ->add('cityBill');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
