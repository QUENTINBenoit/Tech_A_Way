<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Product;
use App\Form\CategoryReductType;
use App\Form\CategoryType;
use App\Form\PictureType;
use App\Repository\CategoryRepository;
use App\Service\PictureUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/category", name="admin_category_")
 */
class CategoryController extends AbstractController
{

    private $pictureUploader;
    public function __construct(PictureUploader $pictureUploader)
    {
        $this->pictureUploader = $pictureUploader;
    }

   /**
     * @Route("/", name="index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
            'colors' => ['primary', 'success', 'danger', 'warning', 'secondary', 'info'],
        ]);
    }

    /**
     * @Route("/tree-structure", name="tree_structure")
     */
    public function treeStructure(CategoryRepository $categoryRepository): Response
    {
        $allCategories = $categoryRepository->findAll();

        $maincategories = [];
        foreach ($allCategories as $category) {
            // si la catégorie n'a pas de parent
            if (!$category->getCategory()) {
                $maincategories[$category->getId()][] = $category;

                foreach ($category->getSubcategories() as $subCategory) {
                    $maincategories[$category->getId()][$subCategory->getId()][] = $subCategory;

                    foreach ($subCategory->getSubcategories() as $subSubCategory) {
                        $maincategories[$category->getId()][$subCategory->getId()][$subSubCategory->getId()][] = $subSubCategory;
                        
                        foreach ($subSubCategory->getSubcategories() as $subSubSubCategory) {
                            $maincategories[$category->getId()][$subCategory->getId()][$subSubCategory->getId()][$subSubSubCategory->getId()][] = $subSubSubCategory;
                        }
                    }
                }
            }
        }
        // dd($maincategories);
        return $this->render('admin/category/tree.structure.html.twig', [
            'mainCategories' => $maincategories,
        ]);
    }


     /**
     * @Route("/create/mainCategory", name="create_main")
     */
    public function createMainCategory(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryReductType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we use PictureUploader service because construct class Category make injection
            $newFileName = $this->pictureUploader->upload($form, 'picture');
    
            $category->setPicture($newFileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'La catégorie principale ' . $category->getName() . ' a bien été ajoutée');

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin/category/create.main.html.twig', [
            'form' => $form->createView()
        ]);
    }

        /**
     * @Route("/create/subCategory", name="create_sub")
     */
    public function createSubCategory(Request $request, CategoryRepository $categoryRepository)
    {
       if ($categoryRepository->findAll()) {
           
           $category = new Category();
    
           $form = $this->createForm(CategoryType::class, $category);
    
           $form->handleRequest($request);
    
           if ($form->isSubmitted() && $form->isValid()) {
    
                // we use PictureUploader service because construct class Category make injection
                $newFileName = $this->pictureUploader->upload($form, 'picture');
               
                $category->setPicture($newFileName);

               $em = $this->getDoctrine()->getManager();
               $em->persist($category);
               $em->flush();
    
               $this->addFlash('success', 'La sous-catégorie ' . $category->getName() . ' a bien été ajoutée');
    
               return $this->redirectToRoute('admin_category_index');
           }
    
           return $this->render('admin/category/create.sub.html.twig', [
               'form' => $form->createView()
           ]);

       } else {
        return $this->redirectToRoute('admin_category_create_main');
       }

    }

    /**
     * @Route("/{id}/update", name="update")
     */
    public function update(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we use PictureUploader service because construct class Category make injection
            $newFileName = $this->pictureUploader->upload($form, 'picture');
    
            $category->setPicture($newFileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'La catégorie ' . $category->getName() . ' a bien été mise à jour');

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin/category/update.sub.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

     /**
     * @Route("/{id}/update/parent", name="update_parent")
     */
    public function updateParent(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryReductType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                // we use PictureUploader service because construct class Category make injection
                $newFileName = $this->pictureUploader->upload($form, 'picture');
        
                $category->setPicture($newFileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'La catégorie ' . $category->getName() . ' a bien été mise à jour');

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin/category/update.main.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }


    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(Category $category, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Vous ne pouvez pas accéder à cette page');

        $submitedToken = $request->query->get('token') ?? $request->request->get('token');

        // 'delete-item' est la même clé utilisée dans le template pour générer le token
        if ($this->isCsrfTokenValid('delete-category', $submitedToken)) {
            
            $em = $this->getDoctrine()->getManager();
            foreach ($category->getSubcategories() as $subCategory) {

                foreach ($subCategory->getSubcategories() as $subCategory2) {
                
                    foreach ($subCategory2->getSubcategories() as $subCategory3) {
                        foreach ($subCategory3->getSubcategories() as $subCategory4) {
                
                            foreach ($subCategory4->getSubcategories() as $subCategory5) {
                

                            }
                            $em->remove($subCategory4);
                            $em->flush();
                        }
                        $em->remove($subCategory3);
                        $em->flush();

                    }
                    $em->remove($subCategory2);
                    $em->flush();
                }
                $em->remove($subCategory);
                $em->flush();

            }
            $em->remove($category);
            $em->flush();

            $this->addFlash('success', 'Catégorie supprimée avec succes');

            return $this->redirectToRoute('admin_category_index');
        } else {
            return new Response('Action interdite', 403);
        }
    }

   /**
     * @Route("/{id}/list-products", name="list_products")
     */
    public function listProducts(Category $category): Response
    {

        return $this->render('admin/category/list.products.html.twig', [
            'category' => $category,
        ]);
    }

  
    
}
