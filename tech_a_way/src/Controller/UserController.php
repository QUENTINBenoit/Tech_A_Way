<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CustomerType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/acount/user", name="acount_user_")
 */
class UserController extends AbstractController
{

        /**
     * @Route("/{id}", name="read", methods={"GET","POST"})
     */
    public function read($id, UserRepository $userRepository, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user= $userRepository->findWithAllDetails($id);

        $form = $this->createForm(CustomerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainPassword = $form->get('password')->getData();

            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plainPassword
                );

                $user->setPassword($hashedPassword);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acount_user_read', ['id' => $user->getId()], 301);
        }



        
        return $this->render('user/read.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
