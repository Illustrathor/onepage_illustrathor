<?php

namespace App\Extensions\Portfolio\Repository;

use App\Extensions\Portfolio\Entity\Son;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Son|null find($id, $lockMode = null, $lockVersion = null)
 * @method Son|null findOneBy(array $criteria, array $orderBy = null)
 * @method Son[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Son::class);
    }

    public function findAll()
    {
        $results = $this->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        foreach ($results as $key => $result)
        {
            $result->setEmbed();
        }
        return $results;
    }

    public function findAllMultimedia()
    {
        $results = $this->createQueryBuilder('s')
            ->where("s.type = :type")
            ->setParameter('type', 'youtube')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        foreach ($results as $key => $result)
        {
            $result->setEmbed();
        }
        return $results;
    }

    public function findMultimediaOnline()
    {
        $results = $this->createQueryBuilder('s')
            ->where("s.type = :type")
            ->setParameter('type', 'youtube')
            ->andWhere("s.online = :online")
            ->setParameter('online', 1)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        foreach ($results as $key => $result)
        {
            $result->setEmbed();
        }
        return $results;
    }

    public function findAllSound()
    {
        $results = $this->createQueryBuilder('s')
            ->where("s.type = :type")
            ->setParameter('type', 'soundcloud')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        foreach ($results as $key => $result)
        {
            $result->setEmbed();
        }
        return $results;
    }

    public function findSoundOnline()
    {
        $results = $this->createQueryBuilder('s')
            ->where("s.type = :type")
            ->setParameter('type', 'soundcloud')
            ->andWhere("s.online = :online")
            ->setParameter('online', 1)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        foreach ($results as $key => $result)
        {
            $result->setEmbed();
        }
        return $results;
    }

    // /**
    //  * @return Son[] Returns an array of Son objects
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
    public function findOneBySomeField($value): ?Son
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
