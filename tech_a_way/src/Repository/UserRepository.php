<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Method that returns user's informations with Query Builders:
     * - Infos du user : firstname, lastname, phoneNumber ...
     * - associated addressess
     * - associated orders
     * - associated status
     * - associated modeOfPayment
     *
     * @param int $id
     * @return void
     */
    public function findWithAllDetails($id)
    {
        $qb = $this->createQueryBuilder('u'); // SELECT user.*

        $qb->where('u.id = :id'); // request to avoid an injection
        $qb->setParameter(':id', $id);

        // we will do a join to retrieve information from other entities (tables in database) linked to the user
        // on utilise la méthode leftjoin car elle est moins stricte que la méthode join : en effet, si l'user n'a pas d'adresses associées, on aura quand même les autres informations du user
        $qb->leftJoin('u.addresses', 'addresses');
        $qb->leftJoin('u.orders', 'orders');
        $qb->leftJoin('orders.status', 'status');
        $qb->leftJoin('orders.orderLines', 'orderLines');
        $qb->leftJoin('orders.modeOfPayment', 'modeOfPayment');

        // With the add Select, we ask to retrieve information from other tables
        $qb->addSelect('addresses, orders, status, orderLines, modeOfPayment');

        // we create the SQL queryL
        $query = $qb->getQuery();

        // We execute and we return the result in the form of an array objects of the TvShow class
        // getOneOrNullResult : null if no result or returns 1 object of the User class
        return $query->getOneOrNullResult();
    }

/**
     * Method that returns user's informations with Query Builders:
     * - Infos du user : firstname, lastname, phoneNumber ...
     * - associated addressess
     * - associated orders
     * - associated status
     * - associated modeOfPayment
     *
     * @param int $id
     * @return void
     */
    public function findWithPersonalDetails($id)
    {
        $qb = $this->createQueryBuilder('u'); // SELECT user.*

        $qb->where('u.id = :id'); // request to avoid an injection
        $qb->setParameter(':id', $id);

        // we will do a join to retrieve information from other entities (tables in database) linked to the user
        // on utilise la méthode leftjoin car elle est moins stricte que la méthode join : en effet, si l'user n'a pas d'adresses associées, on aura quand même les autres informations du user
        $qb->leftJoin('u.addresses', 'addresses');
        $qb->leftJoin('u.orders', 'orders');

        // With the add Select, we ask to retrieve information from other tables
        $qb->addSelect('addresses, orders');

        // we create the SQL queryL
        $query = $qb->getQuery();

        // We execute and we return the result in the form of an array objects of the TvShow class
        // getOneOrNullResult : null if no result or returns 1 object of the User class
        return $query->getOneOrNullResult();
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


 public function findByUserOrder($id)
 {

      $qb = $this->createQueryBuilder('customer');
    
      $qb->where('customer.id = :id');
      $qb->setParameter(':id', $id);
       $qb->leftJoin('customer.orders', 'orders');

      $query = $qb->getQuery();
      return $query->getOneOrNullResult(); 
 }



    
}
