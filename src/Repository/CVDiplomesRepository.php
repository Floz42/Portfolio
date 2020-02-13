<?php

namespace App\Repository;

use App\Entity\CVDiplomes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CVDiplomes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CVDiplomes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CVDiplomes[]    findAll()
 * @method CVDiplomes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CVDiplomesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CVDiplomes::class);
    }

    // /**
    //  * @return CVDiplomes[] Returns an array of CVDiplomes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CVDiplomes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
