<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        
        $billing = new Address();
        $billing->setType('Facturation');
        $user->addAddress($billing);

        
        $form = $this->createForm(RegistrationFormType::class, $user);

        // $address = new Address();
        // $form = $this->createForm(RegistrationFormType::class, ['user' => $user, 'address' => $address]);

        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                ),
            );  
            
            // Add clone of $billing data in $delievery to add a second type "Livraison" at the same adress to the database in the other primary id
            $delivery = clone $billing;
            $delivery->setType('Livraison');
            $user->addAddress($delivery);


            $delivery = clone $billing;
            $delivery->setType('Livraison');
            $user->addAddress($delivery);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($billing);
            $entityManager->persist($delivery);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', 'L\'utilisateur ' . $user->getFirstname() . ' ' . $user->getLastname() . ' a bien été créé');
            
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
