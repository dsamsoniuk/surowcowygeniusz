<?php

namespace App\Repository;

use App\Entity\User2build;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User2build|null find($id, $lockMode = null, $lockVersion = null)
 * @method User2build|null findOneBy(array $criteria, array $orderBy = null)
 * @method User2build[]    findAll()
 * @method User2build[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class User2buildRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User2build::class);
    }

//    /**
//     * @return User2build[] Returns an array of User2build objects
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
    public function findOneBySomeField($value): ?User2build
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