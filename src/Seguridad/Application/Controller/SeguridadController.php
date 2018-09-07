<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Seguridad\Application\Controller;

/**
 * Description of SeguridadController
 *
 * @author joheras
 * 
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Seguridad\Domain\Repository\ICommentRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SeguridadController extends AbstractController {

    private $commentsrepository;

    function __construct(ICommentRepository $commentsrepository) {
        $this->commentsrepository = $commentsrepository;
    }

    public function loginPersona(AuthenticationUtils $authenticationUtils) {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        '@seguridad/loginPersona.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }

    public function comments() {
        $comments = $this->commentsrepository->findAll();
        return new Response(implode("<br/>", $comments));
    }

    public function comment($id) {
        $comment = $this->commentsrepository->findComment($id);
        $this->denyAccessUnlessGranted('edit', $comment);
        return new Response($comment);
    }

    public function admin() {
        return new Response('Pagina administración');
    }

    public function usuario() {
        return new Response('Bienvenido a la zona de usuarios');
    }

    public function login(AuthenticationUtils $authenticationUtils) {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        '@seguridad/login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }

}
