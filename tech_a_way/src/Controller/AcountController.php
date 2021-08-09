<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressBackofficeType;
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
class AcountController extends AbstractController
{

    /**
     * @Route("/{id}", name="read_or_update", methods={"GET","POST"})
     */
    public function readorUpdate($id, UserRepository $userRepository, Request $request): Response
    {
        $user = $userRepository->findWithAllDetails($id);

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
    public function updateAddress($userId, $addressId, AddressRepository $addressRepository, Request $request, UserRepository $userRepository): Response
    {
        $address= $addressRepository->find($addressId);
        
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($address->getType());
            
            $em = $this->getDoctrine()->getManager();


            $addressesUser = $userRepository->find($userId)->getAddresses();
            $billNumber = 0;
            $deliveryNumber = 0;
            foreach ($addressesUser as $addressUser){
                    if ($address->getType() == "Facturation" && $addressUser->getType() == "Facturation") {
                        $billNumber++;
                        if($billNumber >=2) {
                            $this->addFlash('danger', 'Votre adresse ' . $addressUser->getStreet() . ', ' . $addressUser->getZipcode() . ' ' . $addressUser->getCity() . ' comporte déjà le type facturation. Vous ne pouvez choisir qu\'une seule adresse de facturation. Vous devez d\'abord définir l\'autre adresse comme secondaire afin de pouvoir réattribuer le TYPE FACTURATION sur cette adresse,');
                            return $this->redirectToRoute('acount_user_update_address', ['userId' => $userId, 'addressId' => $addressId], 301);
                        }
                    }
                    if ($address->getType() == "Livraison" && $addressUser->getType() == "Livraison") {
                        $deliveryNumber++;
                        if($deliveryNumber >=2) {
                            $this->addFlash('danger', 'Votre adresse ' . $addressUser->getStreet() . ', ' . $addressUser->getZipcode() . ' ' . $addressUser->getCity() . ' comporte déjà le type livraison. Vous ne pouvez choisir qu\'une seule adresse de livraison. Vous devez d\'abord définir l\'autre adresse comme secondaire afin de pouvoir réattribuer le TYPE LIVRAISON sur cette adresse.');
                            return $this->redirectToRoute('acount_user_update_address', ['userId' => $userId, 'addressId' => $addressId], 301);
                        }
                    }
                }

            $em->flush();


            $this->addFlash('success', 'Cette adresse a bien été mise à jour');

            // if this token is valid, it means that I came from the order page, so I will redirect myself to it to finalize the order
            $submitedToken = $request->query->get('token') ?? $request->request->get('token');
            if ($this->isCsrfTokenValid('come-order', $submitedToken)) {
                return $this->redirectToRoute('order_create', ['id' => $userId], 301);
            }
            else {

                return $this->redirectToRoute('acount_user_read_or_update', ['id' => $userId], 301);
            }
            // dd($request->headers->get('referer') );
            //return $this->redirect($_SERVER['HTTP_REFERER']);

        }

        return $this->render('user/updateAddress.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{userId}/address/{addressId}/delete", name="delete_address")
     */
    public function deleteAddress($userId, $addressId, AddressRepository $addressRepository, Request $request)
    {
        $address= $addressRepository->find($addressId);

        $submitedToken = $request->query->get('token') ?? $request->request->get('token');

        // 'delete-item' est la même clé utilisée dans le template pour générer le token
        if ($this->isCsrfTokenValid('delete-address', $submitedToken)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($address);
            $em->flush();

            $this->addFlash('success', 'Adresse supprimée avec succes');

            return $this->redirectToRoute('acount_user_read_or_update', ['id' => $userId], 301);
        } else {
            return new Response('Action interdite', 403);
        }
    }

    /**
     * @Route("/{userId}/address/create", name="create_address")
     */
    public function createNewAddress(Request $request, $userId, UserRepository $userRepository)
    {
        $address = new Address();
        // dd($this->getUser());
        $address->setUser($this->getUser());
        $form = $this->createForm(AddressBackofficeType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $addressesUser = $userRepository->find($userId)->getAddresses();
            foreach ($addressesUser as $addressUser){
                    if ($address->getType() == "Facturation" && $addressUser->getType() == 'Facturation') {
                        $this->addFlash('danger', 'Votre adresse ' . $addressUser->getStreet() . ', ' . $addressUser->getZipcode() . ' ' . $addressUser->getCity() . ' comporte déjà le type facturation. Vous ne pouvez choisir qu\'une seule adresse de facturation. Vous devez d\'abord définir l\'autre adresse comme secondaire afin de pouvoir réattribuer le TYPE FACTURATION sur cette adresse,');
                        return $this->redirectToRoute('acount_user_create_address', ['userId' => $userId], 301);
                    }
                    if ($address->getType() == "Livraison" && $addressUser->getType() == 'Livraison') {
                        $this->addFlash('danger', 'Votre adresse ' . $addressUser->getStreet() . ', ' . $addressUser->getZipcode() . ' ' . $addressUser->getCity() . ' comporte déjà le type livraison. Vous ne pouvez choisir qu\'une seule adresse de livraison. Vous devez d\'abord définir l\'autre adresse comme secondaire afin de pouvoir réattribuer le TYPE LIVRAISON sur cette adresse.');
                        return $this->redirectToRoute('acount_user_create_address', ['userId' => $userId], 301);
                    }
                }

            $em->persist($address);
            $em->flush();

            $this->addFlash('success', 'L\'adresse ' . $address->getid() . ' de l\'utilisateur numéro ' . $userId .' a bien été ajoutée');

  
            // if this token is valid, it means that I came from the order page, so I will redirect myself to it to finalize the order
            $submitedToken = $request->query->get('token') ?? $request->request->get('token');
            if ($this->isCsrfTokenValid('come-order', $submitedToken)) {
                return $this->redirectToRoute('order_create', ['id' => $userId], 301);
            }
            else {

                return $this->redirectToRoute('acount_user_read_or_update', ['id' => $userId], 301);
            }

        }

        return $this->render('user/createAddress.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
