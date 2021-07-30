<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
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
     * Find all details of one product
     *
     * @param int $id
     * @return void
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
           ->addSelect('brand, categories, pictures');

        // Get the query
        $query = $qb->getQuery();

        // Return the result if it's find otherwise null
        return $query->getOneOrNullResult();
    }



    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
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
