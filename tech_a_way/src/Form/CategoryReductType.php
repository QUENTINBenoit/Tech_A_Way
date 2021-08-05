<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryReductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = $builder->getData();

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la catégorie'
            ])
            ->add('subtitle', null, [
                'label' => 'Phrase d\'accroche'
            ])
            ->add('picture', FileType::class, [
                'label' => $category->getPicture() !== null ? "Modifier l'image de la catégorie" : "Ajouter une image",

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k'
                    ])
                ],
            ])
            // ->add('products', EntityType::class, [
            //     'class' => Product::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
