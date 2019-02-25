<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Commentary;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainController extends AbstractController
{


    /**
     * @Route("/", name="index")
     */
    // public function index(): Response // Response devuelve una vista
    // {
       

    //     return $this->render('formulario.html.twig');
    // }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response // Response devuelve una vista
    {
       
        $repositorioCommentary = $this->getDoctrine()->getRepository(Commentary::class);
        $comments = $repositorioCommentary->findByAnswered(false);
        $commentsAnswered = $repositorioCommentary->findByAnswered(true);

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $correo = $user->getEmail();

        return $this->render('admin.html.twig', ["comments"=>$comments, "commentsAnswered"=>$commentsAnswered, "correo"=>$correo]);
    }


    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto(): Response // Response devuelve una vista
    {

        return $this->render('contacto.html.twig');
    }

    /**
     * @Route("/tratarContacto", name="tratarContacto")
     */
    public function tratarContacto(Request $request): Response // Response devuelve una vista
    {

         if(isset($request)){

            $entityManager = $this->getDoctrine()->getManager();

            $commentary = new Commentary();
            $commentary->setCorreo($_POST["email"]);
            $commentary->setText($_POST["comentario"]);
            $commentary->setAnswered(false);

            $entityManager->persist($commentary);
            $entityManager->flush();

         }

        return $this->render('contacto.html.twig');
    }

    /**
     * @Route("/responderComentario", name="responderComentario")
     */
    public function responderComentario(Request $request): Response // Response devuelve una vista
    {

         if(isset($request)){

            $repositorioComments = $this->getDoctrine()->getRepository(Commentary::class);
            $comentarioRespondido = $repositorioComments->findOneById($_POST["validar"]);

            $comentarioRespondido->setAnswered(true);
            $comentarioRespondido->setAnswer($_POST["respuesta"]);

            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->merge($formulariosSinValidar[0]); Usar cuando se crean varios objetos
            $entityManager->flush();


            $comments = $repositorioComments->findByAnswered(false);
            $commentsAnswered = $repositorioComments->findByAnswered(true);

            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
            $correo = $user->getEmail();

         }

        return $this->render('admin.html.twig', ["comments"=>$comments, "commentsAnswered"=>$commentsAnswered, "correo"=>$correo]);
    }

}
