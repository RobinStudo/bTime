<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class EventController extends AbstractController
{

    /**
     * @Route("/events", name="event_list")
     */
    public function list(){
        return new Response( 'Event list' );
    }

    /**
     * @Route("/event/add", name="event_add")
     */
    public function add(){
        return new Response( 'Event add' );
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function show( $id ){
        return new Response( 'Event show' . $id );
    }

    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join( $id ){
        return new Response( 'Event join' );
    }
}
