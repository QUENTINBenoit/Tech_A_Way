<?php

namespace App\Service;

class LinkProductDirectlyWithParentsCategory
{
    

    public function link($product, $categoryRepository)
    {
        // procedure to link the product directly to the parents of the chosen category
        $arrayofObjectCategory = [];
        foreach ($product->getCategories() as $value ){
            $arrayofObjectCategory[] = $value->getCategory()->getId();
            if($value->getCategory()->getCategory()) {
                $arrayofObjectCategory[] = $value->getCategory()->getCategory()->getId();
                if($value->getCategory()->getCategory()->getCategory()) {
                    $arrayofObjectCategory[] = $value->getCategory()->getCategory()->getCategory()->getId();
                    if($value->getCategory()->getCategory()->getCategory()->getCategory()) {
                        $arrayofObjectCategory[] = $value->getCategory()->getCategory()->getCategory()->getCategory()->getId();
                    }
                }
            }

        }
        return $arrayofObjectCategory;
    }
}