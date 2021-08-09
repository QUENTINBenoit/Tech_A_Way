<?php 
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Repository\CategoryRepository;

use Symfony\Config\TwigConfig;
class EventListener {
    /**
     * @var \Twig\Environment
     */
    private $twig;
    
    /**
     * @var \App\Repository\CategoryRepository
     */
    private $categoryRepository;
  

    public function __construct(Environment $twig, CategoryRepository $categoryRepository) {
        $this->twig     = $twig;
        $this->categoryRepository = $categoryRepository;
    }


    public function onKernelController(Environment $twig, CategoryRepository $categoryRepository,TwigConfig $twig):void
    {
        dd('ok');
        // Get all the site settings
        $categoryList = $this->categoryRepository->findBy([
            'category'=> null
        ]);
       
        // Add theme to twig globals under the key settings
        // $this->twig->addGlobal( 'headerCategoryList', $categoryList);
        $twig->global('headerCategoryList')->value($categoryList);
    }
}