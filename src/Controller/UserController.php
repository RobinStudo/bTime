<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\RegisterType;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register( Request $request, UserPasswordEncoderInterface $encoder ){
        $user = new User();
        $form = $this->createForm( RegisterType::class, $user );

        $form->handleRequest( $request );
        if( $form->isSubmitted() && $form->isValid() ){
            $user->addRole( 'ROLE_USER' );

            $password = $encoder->encodePassword( $user, $user->getPlainPassword() );
            $user->setPassword( $password );

            $em = $this->getDoctrine()->getManager();
            $em->persist( $user );
            $em->flush();

            return $this->redirectToRoute( 'event_list' );
        }

        return $this->render('user/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/login", name="user_login")
     */
    public function login( AuthenticationUtils $authUtils ){
        return $this->render( 'user/login.html.twig', array(
            'lastUsername' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/logout", name="user_logout")
     */
    public function logout(){}
}
