<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('exclTaxesPrice')
            ->add('salesTax', ChoiceType::class, [
                'choices' => [
                    '20' => 20
                ],
            ])
            ->add('inclTaxesPrice')
            ->add('reference')
            ->add('description', TextType::class)
            ->add('stock')
            ->add('statusRecent', ChoiceType::class, [
                'choices' => [
                    '0' => 0,
                    '1' => 1
                ],
                ])
            ->add('statusPromotion', ChoiceType::class, [
                'choices' => [
                    '0' => 0,
                    '1' => 1
                ],
                ])
            ->add('percentagePromotion', ChoiceType::class, [
                'choices' => [
                    '0' => 0,
                    '10' => 10,
                    '20' => 20,
                    '30' => 30,
                    '40' => 40
                ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
