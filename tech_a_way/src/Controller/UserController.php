<?php

namespace App\Controller;

use App\Entity\User;
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
     * @Route("/{id}", name="update", methods={"GET","POST"})
     */
    public function update(Request $request, User $user, UserPasswordHasherInterface $passwordHasher): Response
    {

        $form = $this->createForm(UserType::class, $user);
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

            return $this->redirectToRoute('acount_user_update');
        }

        return $this->render('user/read.update.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
