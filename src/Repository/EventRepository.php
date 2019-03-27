<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class EventRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry){
        parent::__construct($registry, Event::class);
    }

    public function search( $query, $sort ){
        $stmt = $this->createQueryBuilder( 'e' );

        $stmt->where( 'e.name LIKE :query' );
        $stmt->setParameter( ':query', '%' . $query . '%' );

        $stmt->orderBy( 'e.' . $sort, 'DESC' );

        return $stmt->getQuery()->getResult();
    }

    public function countIncoming(){
        $stmt = $this->createQueryBuilder( 'e' );

        $stmt->select( 'COUNT( e )' );
        $stmt->where( 'e.startAt > CURRENT_TIMESTAMP()' );

        return $stmt->getQuery()->getSingleScalarResult();
    }
}
