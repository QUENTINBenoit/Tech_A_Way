<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            //->add('inclTaxesPrice')
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

                ->add('brand', EntityType::class, [
                    'class' => Brand::class,
                    'choice_label' => 'name'
                ])
                ->add('categories', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                        ->where('c.category IS NOT NULL');
                    },
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
