<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame'
                ],
            ])
            ->add('phoneNumber')
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
                'choices' => [

                    'Super Administrateur' => 'ROLE_SUPER_ADMIN',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Catalog manager' => 'ROLE_CATALOG_MANAGER',
                    'désactiver profil admin' =>'ROLE_DEACTIVATE_ADMIN'
                ],
                'expanded' => true,
                'multiple'  => true,
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false
            ])
            ->add('birthdate', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('addresses', CollectionType::class, [
                'label' => 'Votre adresse',
                'entry_type' => AddressType::class,
                'entry_options' => ['label' => false],
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                // Before building the form, we will first check in which context we are
                // - Creation : password required
                // - Edition : password optional
                $form = $event->getForm();
                $userData = $event->getData();

                if ($userData->getId() === null) {
        
                    $required = true;

                } else {
      
                    $required = false;
                }

                $form->add('password', PasswordType::class, [
                    'mapped' => false,
                    'required' => $required
                ]);
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
