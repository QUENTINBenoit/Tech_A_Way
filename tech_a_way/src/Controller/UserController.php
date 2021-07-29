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
     * @Route("/{id}", name="read", methods={"GET","POST"})
     */
    public function read($id, UserRepository $userRepository): Response
    {
        return $this->render('user/read.html.twig', [
            'user' => $userRepository->findWithAllDetails($id),
        ]);
    }
}
