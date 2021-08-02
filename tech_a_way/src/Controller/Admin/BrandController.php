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
}
