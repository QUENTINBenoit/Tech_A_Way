<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\CategoryReductType;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/category", name="admin_category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $allCategories = $categoryRepository->findAll();

        // 1) on récupère toutes les catégories qui ont au moins 1 parent
        $subSubCategories = [];
        foreach ($allCategories as $category) {
            // si la catégorie a un parent
            if ($category->getCategory()) {
                
                // si la catégorie n'a pas de parent
                if (!$category->getCategory()->getCategory()){
                    $subSubCategories[$category->getName()] = $category;
                    
                } else {
                    if (!$category->getCategory()->getCategory()->getCategory()){
                        $subSubCategories[$category->getName()] = $category;  
                    } else {
                        if (!$category->getCategory()->getCategory()->getCategory()->getCategory()){
                            $subSubCategories[$category->getName()] = $category;  
                        } else {
                            if (!$category->getCategory()->getCategory()->getCategory()->getCategory()->getCategory()){
                                $subSubCategories[$category->getName()] = $category;  
                            }

                        }
                    }
                }
            } 
        }
        
        // 2) on récupère toutes les catégories qui sont les plus en bas de la hiérarchie (on supprime donc les catégories intermédiaires)
        $number = 0;
        foreach( $subSubCategories as $subSubCategory) {
            
            if($number != 0) {
                $numberCheck = 0;
                foreach ($subSubCategories as $check) {
                    if ($subSubCategory == $check->getCategory()) {
                        $numberCheck++;
                    }
                    if ($numberCheck >=2) {
                        unset($subSubCategories[array_search($check->getCategory(), $subSubCategories)]);
                    }
                } 
            }
            $number++;
        }
        // dd($subSubCategories);
        
        //3) on classe les catégories 
        $subCategoriesClassified = [];
        foreach( $subSubCategories as $subSubCategory){

            if($subSubCategory->getCategory()) {
                if($subSubCategory->getCategory()->getCategory()) {

                    if($subSubCategory->getCategory()->getCategory()->getCategory()) {

                        if($subSubCategory->getCategory()->getCategory()->getCategory()->getCategory()) {

                        } else {
                            $subCategoriesClassified[$subSubCategory->getCategory()->getCategory()->getCategory()->getId()][$subSubCategory->getId()] =  $subSubCategory;
                        }
                    } else {
                        $subCategoriesClassified[$subSubCategory->getCategory()->getCategory()->getId()][$subSubCategory->getId()] =  $subSubCategory;
                    }

                } else {
                    $subCategoriesClassified[$subSubCategory->getCategory()->getId()][$subSubCategory->getId()] =  $subSubCategory;
                    $subCategoriesClassified[$subSubCategory->getCategory()->getId()]['parent 1'] =  $subSubCategory->getCategory()->getSubcategories();

                }
            }
        }
        // dd($subCategoriesClassified);
    


     
   

        return $this->render('admin/category/index2.html.twig', [
            'categories' => $allCategories,
            'subCategoriesClassified' => $subCategoriesClassified,
            'colors' => ['primary', 'success', 'danger', 'warning', 'secondary', 'info'],
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
    public function createSubCategory(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'La sous-catégorie ' . $category->getName() . ' a bien été ajoutée');

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin/category/create.sub.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
