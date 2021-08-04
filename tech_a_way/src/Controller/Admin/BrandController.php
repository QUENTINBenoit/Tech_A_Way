<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use App\Service\PictureUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/brand", name="admin_brand_")
 */
class BrandController extends AbstractController
{

    private $pictureUploader;
    public function __construct(PictureUploader $pictureUploader)
    {
        $this->pictureUploader = $pictureUploader;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(BrandRepository $brandRepository): Response
    {
        return $this->render('admin/brand/index.html.twig', [
            'brands' => $brandRepository->findAll(),
        ]);
    }

        /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $brand = new Brand();

        $form = $this->createForm(BrandType::class, $brand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we use PictureUploader service because construct class Category make injection
            $newFileName = $this->pictureUploader->upload($form, 'logo');

            $brand->setLogo($newFileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($brand);
            $em->flush();

            $this->addFlash('success', 'La marque ' . $brand->getName() . ' a bien été ajoutée');

            return $this->redirectToRoute('admin_brand_index');
        }

        return $this->render('admin/brand/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="update")
     */
    public function update(Brand $brand, Request $request)
    {
        $form = $this->createForm(BrandType::class, $brand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we use PictureUploader service because construct class Category make injection
            $newFileName = $this->pictureUploader->upload($form, 'logo');

            $brand->setLogo($newFileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'La marque ' . $brand->getName() . ' a bien été mise à jour');

            return $this->redirectToRoute('admin_brand_update', ['id' => $brand->getId()]);
        }

        return $this->render('admin/brand/update.html.twig', [
            'form' => $form->createView(),
            'brand' => $brand
        ]);
    }

        /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(Brand $brand, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Vous ne pouvez pas accéder à cette page');

        $submitedToken = $request->query->get('token') ?? $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-brand', $submitedToken)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($brand);
            $em->flush();

            $this->addFlash('success', 'Marque supprimée avec succes');

            return $this->redirectToRoute('admin_brand_index');
        } else {
            return new Response('Action interdite', 403);
        }
    }
}
