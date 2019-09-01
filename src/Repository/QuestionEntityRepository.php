<?php

namespace App\Repository;

use App\Entity\QuestionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuestionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionEntity[]    findAll()
 * @method QuestionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionEntity::class);
    }

    // /**
    //  * @return QuestionEntity[] Returns an array of QuestionEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionEntity
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
