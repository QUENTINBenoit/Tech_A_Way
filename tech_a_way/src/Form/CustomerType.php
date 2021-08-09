<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sexe',
                'placeholder' => 'Choisissez',
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame'
                ],
            ])
            ->add('phoneNumber', null, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('email', EmailType::class)
      
            ->add('birthdate', DateType::class, array(
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
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


            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
