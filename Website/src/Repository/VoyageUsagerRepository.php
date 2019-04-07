<?php

namespace App\Repository;

use App\Entity\VoyageUsager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VoyageUsager|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoyageUsager|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoyageUsager[]    findAll()
 * @method VoyageUsager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageUsagerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VoyageUsager::class);
    }

    // /**
    //  * @return VoyageUsager[] Returns an array of VoyageUsager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoyageUsager
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
