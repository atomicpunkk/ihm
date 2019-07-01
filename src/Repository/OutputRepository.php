<?php

namespace App\Repository;

use App\Entity\Output;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Output|null find($id, $lockMode = null, $lockVersion = null)
 * @method Output|null findOneBy(array $criteria, array $orderBy = null)
 * @method Output[]    findAll()
 * @method Output[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OutputRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Output::class);
    }

    // /**
    //  * @return Output[] Returns an array of Output objects
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
    public function findOneBySomeField($value): ?Output
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
