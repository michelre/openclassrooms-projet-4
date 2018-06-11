<?php

namespace App\Repository;

use App\Entity\Billey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Billey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Billey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Billey[]    findAll()
 * @method Billey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BilleyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Billey::class);
    }

//    /**
//     * @return Billey[] Returns an array of Billey objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Billey
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
