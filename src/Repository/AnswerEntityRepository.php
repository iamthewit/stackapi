<?php

namespace App\Repository;

use App\Entity\AnswerEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AnswerEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerEntity[]    findAll()
 * @method AnswerEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerEntity::class);
    }

    // /**
    //  * @return AnswerEntity[] Returns an array of AnswerEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnswerEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
