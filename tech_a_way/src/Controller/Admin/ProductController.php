<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Service\LinkProductDirectlyWithParentsCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/product", name="admin_product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

     /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, ProductRepository $productRepository ,CategoryRepository $categoryRepository, LinkProductDirectlyWithParentsCategory $linkProductDirectlyWithParentsCategory)
    {
        $product = new Product();
        
        $form = $this->createForm(ProductType::class, $product);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $arrayofObjectCategory = $linkProductDirectlyWithParentsCategory->link($product, $categoryRepository);



            foreach ($arrayofObjectCategory as $index) {
                $product->addCategory($categoryRepository->find(intval($index)));
            }
            

            $em->persist($product);
            
            $em->flush();
            
        


            
            $this->addFlash('success', 'Le produit ' . $product->getName() . ' a bien été ajouté');

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin/product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="update")
     */
    public function update(Product $product, Request $request, CategoryRepository $categoryRepository, LinkProductDirectlyWithParentsCategory $linkProductDirectlyWithParentsCategory)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();


            $arrayofObjectCategory = $linkProductDirectlyWithParentsCategory->link($product, $categoryRepository);



            foreach ($arrayofObjectCategory as $index) {
                $product->addCategory($categoryRepository->find(intval($index)));
            }




            $em->flush();

            $this->addFlash('success', 'Le ' . $product->getName() . ' a bien été mis à jour');

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin/product/update.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);
    }
}
