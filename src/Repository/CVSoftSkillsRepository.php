<?php

namespace App\Repository;

use App\Entity\CVSoftSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CVSoftSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method CVSoftSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method CVSoftSkills[]    findAll()
 * @method CVSoftSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CVSoftSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CVSoftSkills::class);
    }

    // /**
    //  * @return CVSoftSkills[] Returns an array of CVSoftSkills objects
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
    public function findOneBySomeField($value): ?CVSoftSkills
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
