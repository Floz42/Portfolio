<?php

namespace App\Repository;

use App\Entity\CVExperiences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CVExperiences|null find($id, $lockMode = null, $lockVersion = null)
 * @method CVExperiences|null findOneBy(array $criteria, array $orderBy = null)
 * @method CVExperiences[]    findAll()
 * @method CVExperiences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CVExperiencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CVExperiences::class);
    }

    // /**
    //  * @return CVExperiences[] Returns an array of CVExperiences objects
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
    public function findOneBySomeField($value): ?CVExperiences
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
