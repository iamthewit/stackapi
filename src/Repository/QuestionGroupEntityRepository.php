<?php

namespace App\Repository;

use App\Entity\QuestionGroupEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuestionGroupEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionGroupEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionGroupEntity[]    findAll()
 * @method QuestionGroupEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionGroupEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionGroupEntity::class);
    }

    // /**
    //  * @return GroupEntity[] Returns an array of GroupEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupEntity
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
