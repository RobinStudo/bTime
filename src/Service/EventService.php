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

    public function getAll(){
        return $this->repository->findAll();
    }

    public function get( $id ){
        return $this->repository->find( $id );
    }
}
