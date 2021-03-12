<?php

namespace App\Repository;

use App\Entity\Commmentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commmentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commmentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commmentaire[]    findAll()
 * @method Commmentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommmentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commmentaire::class);
    }

    // /**
    //  * @return Commmentaire[] Returns an array of Commmentaire objects
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
    public function findOneBySomeField($value): ?Commmentaire
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
