<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
      /*
       * Méthode permettant de retourner les infos de l'utilisateur en fonction de sa commande
       * query builder
       * @param int $id
       * @return void
       

 public function findByUserOder($id)
 {
      // On Instancie le querybuilder
      $qb = $this->createQueryBuilder('costumer');//  SELECT * FROM order
      // je cible l'utilisateur demander  ( SELECT user.* WEHERE id= $id)
      $qb->where('costumer.id = :id');
      $qb->setParameter(':id', $id);
       // j'utilise une jointure pour ce faire je prend la methodes leftJoin moin strict que Joint
       $qb->leftJoin('costumer.user', 'users');

      // je crée un rqueter SQL
      $query = $qb->getQuery();
       // On execute et on retourne le résultat sous lea forme de tableau
       // d'abjet des class User 
      return $query->getOneOrNullResult(); 
 }
*/

}
