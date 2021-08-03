<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit'
            ])
            ->add('exclTaxesPrice', null, [
                'label' => 'Montant Hors Taxes'
            ])
            ->add('salesTax', ChoiceType::class, [
                'label' => 'TVA',
                'choices' => [
                    '20' => 20
                ],
            ])
            //->add('inclTaxesPrice')
            ->add('reference', IntegerType::class, [
                'label' => 'Référence du produit'
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Stock restant'
            ])
            ->add('statusRecent', ChoiceType::class, [
                'label' => 'Statut récent',
                'choices' => [
                    '0' => 0,
                    '1' => 1
                ],
                ])
            ->add('statusPromotion', ChoiceType::class, [
                'label' => 'Statut promotion',
                'choices' => [
                    '0' => 0,
                    '1' => 1
                ],
                ])
            ->add('percentagePromotion', ChoiceType::class, [
                'label' => 'Pourcentage promotion appliqué',
                'choices' => [
                    '0' => 0,
                    '10' => 10,
                    '20' => 20,
                    '30' => 30,
                    '40' => 40
                ],
                ])

                ->add('brand', EntityType::class, [
                    'label' => 'Choisir la MARQUE dans laquelle le produit se trouve',
                    'class' => Brand::class,
                    'choice_label' => 'name'
                ])
                ->add('categories', EntityType::class, [
                    'label' => 'Choisir la(les) plus petite(s) CATEGORIE(s) dans laquelle(lesquelles) le produit se trouve',
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
