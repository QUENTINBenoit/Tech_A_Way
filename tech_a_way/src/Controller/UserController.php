<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Form\CustomerType;
use App\Repository\AddressRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/acount/user", name="acount_user_", requirements={"adressId" = "\d+"}, requirements={"userId" = "\d+"}, requirements={"id" = "\d+"})
 */
class UserController extends AbstractController
{

    /**
     * @Route("/{id}", name="read_or_update", methods={"GET","POST"})
     */
    public function readorUpdate($id, UserRepository $userRepository, Request $request): Response
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

    /**
     * @Route("/{userId}/address/{addressId}/update", name="update_address", methods={"GET","POST"})
     */
    public function updateAddress($userId, $addressId, AddressRepository $addressRepository, Request $request): Response
    {
        $address= $addressRepository->find($addressId);

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cette adresse a bien été mise à jour');

            return $this->redirectToRoute('acount_user_read_or_update', ['id' => $userId], 301);
        }

        return $this->render('user/updateAddress.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{userId}/address/create", name="create_address")
     */
    public function add(Request $request, $userId)
    {
        $address = new Address();
        // dd($this->getUser());
        $address->setUser($this->getUser());
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $this->addFlash('success', 'L\'adresse ' . $address->getid() . ' de l\'utilisateur numéro ' . $userId .' a bien été ajoutée');

            return $this->redirectToRoute('acount_user_read_or_update', ['id' => $userId], 301);
            
        }

        return $this->render('user/createAddress.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
