<?php

namespace App\Repository;

use App\Entity\UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method UserEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }

    // /**
    //  * @return UserEntity[] Returns an array of UserEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserEntity
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return UserEntity[]
     */
    public function findAll()
    {
        return $this->findAllQuery()->getResult();
    }

    /**
     * @param int $page
     * @param int $perPage
     *
     * @return UserEntity[]
     */
    public function findAllAndPaginate(int $page, int $perPage)
    {
        $q = $this->findAllQuery()
                  ->setFirstResult($perPage * ($page - 1))
                  ->setMaxResults($perPage);

        return (new Paginator($q))->getQuery()->getResult();
    }

    /**
     * @return Query
     */
    private function findAllQuery()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('u')
           ->from(UserEntity::class, 'u')
           ->where('u.deletedAt IS NULL');

        return $qb->getQuery();
    }
}
