<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EventService;
use App\Entity\Event;

class EventController extends AbstractController
{

    /**
     * @Route("/events", name="event_list")
     */
    public function list( Request $request, EventService $eventService ){
        $query = $request->query->get( 'query' );
        $sort = $request->query->get( 'sort', 'id' );

        if( !empty( $query ) ){
            $events = $eventService->search( $query, $sort );
        }else{
            $events = $eventService->getAll( $sort );
        }

        return $this->render( 'event/list.html.twig', array(
            'events' => $events,
            'incomingCounter' => $eventService->countIncoming(),
        ));
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
    public function show( EventService $eventService, $id ){
        $event = $eventService->get( $id );

        if( empty( $event ) ){
            return new Response( 'Event Not Found', 404 );
        }

        return $this->render( 'event/show.html.twig', array(
            'event' => $event,
        ));
    }

    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join( $id ){
        return new Response( 'Event join' );
    }
}
