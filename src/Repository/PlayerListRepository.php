<?php

namespace App\Repository;

use App\Entity\PlayerList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerList|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerList|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerList[]    findAll()
 * @method PlayerList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerList::class);
    }

    // /**
    //  * @return PlayerList[] Returns an array of PlayerList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayerList
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
