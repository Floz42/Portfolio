<?php

namespace App\Repository;

use App\Entity\CVInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CVInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CVInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CVInfos[]    findAll()
 * @method CVInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CVInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CVInfos::class);
    }

    // /**
    //  * @return CVInfos[] Returns an array of CVInfos objects
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
    public function findOneBySomeField($value): ?CVInfos
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
