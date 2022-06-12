<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    public function findFilterProperties($criteria = [])
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.sell = false');
        
            if (array_key_exists("type", $criteria) && !empty($criteria["type"])) {
                $qb->andWhere("p.type = '". $criteria["type"]. "'");
            }
            if (array_key_exists("transactionType", $criteria) && !empty($criteria["transactionType"])) {
                $qb->andWhere('p.transactionType =' .$criteria["transactionType"]);
            }
            if (array_key_exists("roomsMin", $criteria) && !empty($criteria["roomsMin"])) {
                $qb->andWhere($qb->expr()->gte('p.rooms', $criteria["roomsMin"]));
            }
            if (array_key_exists("roomsMax", $criteria) && !empty($criteria["roomsMax"])) {
                $qb->andWhere($qb->expr()->lte('p.rooms', $criteria["roomsMax"]));
            }
            if (array_key_exists("surfaceMin", $criteria) && !empty($criteria["surfaceMin"])) {
                $qb->andWhere($qb->expr()->gte('p.surface', $criteria["surfaceMin"]));
            }
            if (array_key_exists("surfaceMax", $criteria) && !empty($criteria["surfaceMax"])) {
                $qb->andWhere($qb->expr()->lte('p.surface', $criteria["surfaceMax"]));
            }
            if (array_key_exists("priceMin", $criteria) && !empty($criteria["priceMin"])) {
                $qb->andWhere($qb->expr()->gte('p.price', $criteria["priceMin"]));
            }
            if (array_key_exists("priceMax", $criteria) && !empty($criteria["priceMax"])) {
                $qb->andWhere($qb->expr()->lte('p.price', $criteria["priceMax"]));
            }

            return $qb->getQuery()->getResult();
        ;
    }

    /*
    public function findOneBySomeField($value): ?Property
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
