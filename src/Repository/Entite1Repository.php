<?php

namespace App\Repository;

use App\Entity\Entite1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Entite1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entite1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entite1[]    findAll()
 * @method Entite1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Entite1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entite1::class);
    }

    // /**
    //  * @return Entite1[] Returns an array of Entite1 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entite1
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
