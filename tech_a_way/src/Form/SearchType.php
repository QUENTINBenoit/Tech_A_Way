<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', EntityType::class, [
               'label' => false,
                'required' => false,
                 'class' => Category::class,
                 'expanded' => true,
                'multiple' => true,
            ])
            ->add('brand', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Brand::class,
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('statusPromotion', CheckboxType::class, [
                'label' => 'En promotion',
                'required' => false,
               
            ])



            //->add('exclTaxesPrice')
            //->add('salesTax')
            //->add('inclTaxesPrice')
            //->add('reference')
            //->add('description')
            //->add('stock')
            //->add('statusRecent')
            //->add('statusPromotion')
            //->add('percentagePromotion')
            //->add('createdAt')
            //->add('updatedAt')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'method'=> 'GET',
            'csrf_protection' => false
        ]);
    }
}
