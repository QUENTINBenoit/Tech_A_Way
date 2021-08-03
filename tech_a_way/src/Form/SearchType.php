<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
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
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('c')
                        ->where('c.category  = :categoryId')
                        ->setParameter('categoryId', $options['category'])
                    ;
                },
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'method' => 'GET',
            'category' => null,
            'csrf_protection' => false,
        ]);
    }
}
