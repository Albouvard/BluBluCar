<?php

namespace App\Repository;

use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Voyage::class);
    }

    public function findByDepartArrive($depart, $arrive)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.ville_depart = :depart and v.ville_arrive = :arrive')
            ->setParameter('depart', $depart)
            ->setParameter('arrive', $arrive)
            ->orderBy('v.horaire_at', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
<<<<<<< HEAD

    public function findById($id)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

=======
    public function updatePlaces($id,$nbPlaces)
    {
        $db= $this->createQueryBuilder('b')
            ->update()
            ->set('b.nbPlaces',$nbPlaces)
            ->where('b.id='.$id)
            ->getQuery()
            ->execute();
    }
>>>>>>> alexandre
    // /**
    //  * @return Voyage[] Returns an array of Voyage objects
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
    public function findOneBySomeField($value): ?Voyage
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
