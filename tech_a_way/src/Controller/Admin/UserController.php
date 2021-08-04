<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\User;
use App\Form\AddressBackofficeType;
use App\Form\AddressType;
use App\Form\UserType;
use App\Repository\AddressRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/user", name="admin_user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index",methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/orders", name="orders",methods={"GET"})
     */
    public function orders(int $id, UserRepository $userRepository): Response
    {
        return $this->render('admin/user/orders.html.twig', [
            'user' => $userRepository->findWithAllDetails($id),
        ]);
    }

    /**
     * @Route("/{id}/personal", name="personal_details",methods={"GET"})
     */
    public function Personaldetails(int $id, UserRepository $userRepository): Response
    {
        return $this->render('admin/user/personal.details.html.twig', [
            'user' => $userRepository->findWithPersonalDetails($id),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET","POST"})
     */
    public function create(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $billing = new Address();
        $billing->setType('Facturation');
        $user->addAddress($billing);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            // We recover the password in non-hash
            $plainPassword = $form->get('password')->getData();

            // We hash password
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainPassword
            );

            // we update the password property with the new hash password
            $user->setPassword($hashedPassword);

            if(in_array("ROLE_DEACTIVATE_ADMIN", $user->getRoles())) {
                $user->setRoles(["ROLE_USER"]);
              } 
            else if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())) {
                if($this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") {
                    $user->setRoles(["ROLE_SUPER_ADMIN"]);
                } else {
                    $user->setRoles([$this->getUser()->getRoles()[0]]);
                }
            } 
            else if(in_array("ROLE_ADMIN", $user->getRoles())) {
                if (($this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") || ($this->getUser()->getRoles()[0] == "ROLE_ADMIN")) {
                    $user->setRoles(["ROLE_ADMIN"]);
                } else {
                    $user->setRoles([$this->getUser()->getRoles()[0]]);
                }
            } 
            else if(in_array("ROLE_CATALOG_MANAGER", $user->getRoles())) {
                $user->setRoles(["ROLE_CATALOG_MANAGER"]);
            }


            $delivery = clone $billing;
            $delivery->setType('Livraison');
            $user->addAddress($delivery);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($billing);
            $entityManager->persist($delivery);
            $entityManager->flush();

            $this->addFlash('success', 'L\'utilisateur ' . $user->getFirstname() . ' ' . $user->getLastname() . ' a bien été créé');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/create.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/update", name="update", methods={"GET","POST"})
     */
    public function update(Request $request, User $user, UserPasswordHasherInterface $passwordHasher): Response
    {
        // dd($this->getUser()->getRoles()[0]);

        // we will test that the owners of the account or a super admin has the right to modify the user information
        // Symfony call supports method of Voter UserVoter
        $this->denyAccessUnlessGranted('USER_EDIT', $user, 'Seul le propriétaire du compte ou une personne avec un rôle supérieur peut accéder à cette page');

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

            if(in_array("ROLE_DEACTIVATE_ADMIN", $user->getRoles())) {
                $user->setRoles(["ROLE_USER"]);
              } 
            else if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())) {
                if($this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") {
                    $user->setRoles(["ROLE_SUPER_ADMIN"]);
                } else {
                    $user->setRoles([$this->getUser()->getRoles()[0]]);
                }
            } 
            else if(in_array("ROLE_ADMIN", $user->getRoles())) {
                if (($this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") || ($this->getUser()->getRoles()[0] == "ROLE_ADMIN")) {
                    $user->setRoles(["ROLE_ADMIN"]);
                } else {
                    $user->setRoles([$this->getUser()->getRoles()[0]]);
                }
            } 
            else if(in_array("ROLE_CATALOG_MANAGER", $user->getRoles())) {
                $user->setRoles(["ROLE_CATALOG_MANAGER"]);
            }
          
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'utilisateur ' . $user->getFirstname() . ' ' . $user->getLastname() . ' a bien été modifié');


            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/update.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


      /**
     * @Route("/{id}/address/create", name="address_create")
     */
    public function createNewAddress(Request $request, User $user)
    {
           
            $this->denyAccessUnlessGranted('USER_EDIT', $user, 'Seul le propriétaire du compte ou une personne avec un rôle supérieur peut accéder à cette page');
        
            $address = new Address();

       

           $form = $this->createForm(AddressBackofficeType::class, $address);
    
           $form->handleRequest($request);
    
           if ($form->isSubmitted() && $form->isValid()) {
    
                $user->addAddress($address);

               $em = $this->getDoctrine()->getManager();
               $em->persist($user);
                $em->persist($address);
            
               $em->flush();
    
               $this->addFlash('success', 'L\'adresse a bien été ajoutée');
    
               return $this->redirectToRoute('admin_user_personal_details', ['id' => $user->getId()], 301);
           }
    
           return $this->render('admin/user/address.create.html.twig', [
               'form' => $form->createView(),
               'user' => $user,
           ]);
    }


      /**
     * @Route("/{userId}/address/{addressId}/update", name="address_update")
     */
    public function updateAddress($userId, $addressId, Request $request, UserRepository $userRepository, AddressRepository $addressRepository)
    {
            $user = $userRepository->find($userId);
            $address = $addressRepository->find($addressId);
    
            $this->denyAccessUnlessGranted('USER_EDIT', $user, 'Seul le propriétaire du compte ou une personne avec un rôle supérieur peut accéder à cette page');
          

           $form = $this->createForm(AddressBackofficeType::class, $address);
    
           $form->handleRequest($request);
    
           if ($form->isSubmitted() && $form->isValid()) {
    
                $user->addAddress($address);

               $em = $this->getDoctrine()->getManager();
               $em->persist($user);
                $em->persist($address);
            
               $em->flush();
    
               $this->addFlash('success', 'L\'adresse a bien été modifiée');
    
               return $this->redirectToRoute('admin_user_personal_details', ['id' => $user->getId()], 301);
           }
    
           return $this->render('admin/user/address.update.html.twig', [
               'form' => $form->createView(),
               'user' => $user,
           ]);
    }

      /**
     * @Route("/{userId}/address/{addressId}/delete", name="address_delete")
     */
    public function deleteAddress($userId, $addressId, UserRepository $userRepository, AddressRepository $addressRepository, Request $request)
    {
        $user = $userRepository->find($userId);
        $address = $addressRepository->find($addressId);
        $this->denyAccessUnlessGranted('USER_EDIT', $user, 'Seul le propriétaire du compte ou une personne avec un rôle supérieur peut accéder à cette page');
        

        $submitedToken = $request->query->get('token') ?? $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-address', $submitedToken)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($address);
            $em->flush();

            $this->addFlash('success', 'L\'adresse a bien été supprimée');

            return $this->redirectToRoute('admin_user_personal_details', ['id' => $user->getId()], 301);

        } else {
            return new Response('Action interdite', 403);
        }
    }




}
