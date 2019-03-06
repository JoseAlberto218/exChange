<?php

namespace App\Repository;

use App\Entity\Services;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Services|null find($id, $lockMode = null, $lockVersion = null)
 * @method Services|null findOneBy(array $criteria, array $orderBy = null)
 * @method Services[]    findAll()
 * @method Services[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Services::class);
    }

    // /**
    //  * @return Services[] Returns an array of Services objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Services
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByAvailability($value, $value2)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.availability = :val')
            ->andWhere('s.user = :val1')
            ->setParameter('val', $value)
            ->setParameter('val1', $value2)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAvailableAndNotAccepted($value, $value1, $value2)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.availability = :val')
            ->andWhere('s.user = :val1')
            ->andWhere('s.accepted = :val2')
            ->setParameter('val', $value)
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAccepted($value, $value2)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.accepted = :val')
            ->andWhere('s.user = :val1')
            ->setParameter('val', $value)
            ->setParameter('val1', $value2)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByDestacados()
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->orderBy('s.numSolicit', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByNovedad()
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->orderBy('s.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAllDestacados()
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->orderBy('s.numSolicit', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
