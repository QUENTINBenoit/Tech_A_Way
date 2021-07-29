<?php

namespace App\Controller;

use App\Form\CustomerType;
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
     * @Route("/{id}", name="read_or_update", methods={"GET","POST"})
     */
    public function readorUpdate($id, UserRepository $userRepository, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user= $userRepository->findWithAllDetails($id);

        $form = $this->createForm(CustomerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Les données personnelles de  ' . $user->getFirstname(). ' ' . $user->getLastname() . ' ont bien été mises à jour');

            return $this->redirectToRoute('acount_user_read_or_update', ['id' => $user->getId()], 301);
        }



        
        return $this->render('user/readOrUpdate.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
