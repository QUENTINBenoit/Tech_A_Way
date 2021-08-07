<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class UserReductforAddressType extends AbstractType


{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $builder->getData();
        // $userId = $user->getId();

        $builder

        ->add('addresses', EntityType::class, [
            'label' => 'Choisir votre adresse',
            'class' => Address::class,
            'multiple' => true,
            'query_builder' => function(EntityRepository $er) use ($user) {
                return $er->createQueryBuilder('a')
                // ->leftJoin('a.user', 'user')
                // ->addSelect('user')
                ->where('a.user = :user')
                ->setParameter(':user', $user);
       
            },

            // public function findOrderWithAllDetails($id)
            // {
            //     $qb = $this->createQueryBuilder('ord');
        
            //     $qb->where('ord.id = :id');
            //     $qb->setParameter(':id', $id);
        
            //     $qb->leftJoin('ord.orderLines', 'orderLines');
            //     $qb->leftJoin('ord.modeOfPayment', 'modeOfPayment');
            //     $qb->leftJoin('ord.user', 'user');
        
            //     $qb->addSelect('orderLines, modeOfPayment, user');
        
            //     $query = $qb->getQuery();
            //     return $query->getOneOrNullResult();
            // }
            'choice_label' => function ($addresses) {
                return $addresses->getStreet(). ' ' . $addresses->getCity();
            }
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
