<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Product;
use App\Form\PictureType;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use App\Service\LinkProductDirectlyWithParentsCategory;
use App\Service\PictureUploader;
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
            
            $product->setInclTaxesPrice(($product->getExclTaxesPrice()*($product->getSalesTax()/100))+$product->getExclTaxesPrice());

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

            $product->setInclTaxesPrice(($product->getExclTaxesPrice()*($product->getSalesTax()/100))+$product->getExclTaxesPrice());

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

      /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(Product $product, Request $request)
    {
        $submitedToken = $request->query->get('token') ?? $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-product', $submitedToken)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();

            $this->addFlash('success', 'Le produit a bien été supprimé');

            return $this->redirectToRoute('admin_product_index');
        } else {
            return new Response('Action interdite', 403);
        }
    }

      /**
     * @Route("/{id}/picture/create", name="picture_create")
     */
    public function createNewPicture(Request $request, Product $product, PictureUploader $pictureUploader)
    {
            $arrayPictures = [];

            foreach ($product->getPictures() as $picture){
                $arrayPictures[] = $picture;
            }
           
           $picture = new Picture();
    
           $form = $this->createForm(PictureType::class, $picture);
    
           $form->handleRequest($request);
    
           if ($form->isSubmitted() && $form->isValid()) {
    
               
               // we use PictureUploader service because construct class Category make injection
               $newFileName = $pictureUploader->upload($form, 'name');
               if($newFileName == null){
                     $this->addFlash('danger', 'Vous n\'avez pas ajouté de nouvelle image au produit');
                    return $this->redirectToRoute('admin_product_picture_create', ['id' => $product->getId()], 301);
               }
               $picture->setName($newFileName);
               $product->addPicture($picture);
       
               $em = $this->getDoctrine()->getManager();
               $em->persist($picture);
               $em->flush();
    
               $this->addFlash('success', 'L\'image "' . $picture->getName() . '" a bien été ajoutée au produit N°' . $product->getId());
    
               return $this->redirectToRoute('admin_product_picture_create', ['id' => $product->getId()], 301);
           }
    
           return $this->render('admin/product/picture.create.html.twig', [
               'form' => $form->createView(),
               'product' => $product,
               'pictures' => $arrayPictures
           ]);
    }

    /**
     * @Route("/{productId}/picture/{pictureId}delete", name="picture_delete")
     */
    public function deletePicture($productId, $pictureId, PictureRepository $pictureRepository, ProductRepository $productRepository, Request $request)
    {
        $picture = $pictureRepository->find($pictureId);
        $product = $productRepository->find($productId);

        $submitedToken = $request->query->get('token') ?? $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-picture', $submitedToken)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($picture);
            $em->flush();

            $this->addFlash('success', 'L\'image a bien été supprimée');

            return $this->redirectToRoute('admin_product_picture_create', ['id' => $product->getId()], 301);
        } else {
            return new Response('Action interdite', 403);
        }
    }
}
