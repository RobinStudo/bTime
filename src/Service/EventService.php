<?php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;

class EventService{
    private $om;
    private $repository;

    public function __construct( ObjectManager $om ){
        $this->om = $om;
        $this->repository = $om->getRepository( Event::class );
    }

    public function getAll( $sort ){
        return $this->repository->findBy( array(), array(
            $sort => 'DESC'
        ));
    }

    public function get( $id ){
        return $this->repository->find( $id );
    }

    public function countIncoming(){
        return $this->repository->countIncoming();
    }

    public function search( $term, $sort ){
        return $this->repository->search( $term, $sort );
    }
}
