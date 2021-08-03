<?php

namespace App\Repository;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr as QueryExpr;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr as Expr; 
/**
 * @method null|Product find($id, $lockMode = null, $lockVersion = null)
 * @method null|Product findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


     /** 
     * Find all Product and Categories for filter
     * @return void
     */


    public function findByFilter($filter)
    {
       $qb= $this->createQueryBuilder('p');
       if(isset($filter['brand'])){
        $qb->innerJoin(Brand::class, 'b', 'WITH', 'p.brand = b.id');
        foreach($filter['brand'] as $id){
            $qb->orWhere('b.id ='.$id);
        }
       }
       if(isset($filter['categories'])){
        $qb->leftJoin('p.categories', "c");
        $qb->orWhere($qb->expr()->in('c.id', $filter['categories'])); // si le produit dois appartenir à l'une des catégorie 
        $qb->andWhere($qb->expr()->in('c.id', $filter['categories'])); // si le produit dois etre dans les toutes catégorie 
        }

        if(isset($filter['statusPromotion']) ) {
            $qb->where('p.statusPromotion = 1'); 
          //  dd($filter['statusPromotion']); 
       }

       $qb->distinct();
       return $qb->getQuery()->getResult(); 
    }


    /*if (isset($filter['brand'])){
        foreach ($filter['brand'] as $id){ 
        $qb->andWhere('p.id = :id');  
        $qb->setParameter(':id', $id);  
        }
    
    }if (isset($filter['categories'])) {
            foreach ($filter['categories'] as $id) {
                $qb->andWhere('p.id  :id');
                $qb->setParameter(':id', $id);
            }
     }if (isset($filter['statusPromotion'])){
         $filter['statusPromotion'] === "1" ; 
    
         
    

     }*/

    /**
     * Find all details of one product.
     *
     * @param int $id
     */
    public function findOneByDetails($id)
    {
        // Initialized the query builder with alias of the table product
        $qb = $this->createQueryBuilder('p');

        // Search the product which have the primary id get in the parameter
        $qb->where('p.id = :id')
            ->setParameter(':id', $id)
            ->leftJoin('p.brand', 'brand')
            ->leftJoin('p.categories', 'categories')
            ->leftJoin('p.pictures', 'pictures')
            ->addSelect('brand, categories, pictures')
        ;

        // Get the query
        $query = $qb->getQuery();

        // Return the result if it's find otherwise null
        return $query->getOneOrNullResult();
    }

   
 
    //  /**
    // * @return Product[] Returns an array of Product objects
     // */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
