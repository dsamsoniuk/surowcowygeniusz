<?php

namespace App\Repository;

use App\Entity\User2source;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User2source|null find($id, $lockMode = null, $lockVersion = null)
 * @method User2source|null findOneBy(array $criteria, array $orderBy = null)
 * @method User2source[]    findAll()
 * @method User2source[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class User2sourceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User2source::class);
    }

//    /**
//     * @return User2source[] Returns an array of User2source objects
//     */
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
    public function findOneBySomeField($value): ?User2source
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
