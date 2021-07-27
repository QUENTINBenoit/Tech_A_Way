<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
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
       */

 public function findByUserOder($id)
 {
      // On Instancie le querybuilder
      $qb = $this->createQueryBuilder('customer');//  SELECT * FROM order
      // je cible l'utilisateur demander  ( SELECT user.* WEHERE id= $id)
      $qb->where('customer.id = :id');
      $qb->setParameter(':id', $id);
       // j'utilise une jointure pour ce faire je prend la methodes leftJoin moin strict que Joint
       $qb->leftJoin('customer.orders', 'orders');

      // je crée un rqueter SQL
      $query = $qb->getQuery();
       // On execute et on retourne le résultat sous lea forme de tableau
       // d'abjet des class User 
      return $query->getOneOrNullResult(); 
 }
    
}
