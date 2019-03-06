<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Categories;
use App\Entity\Services;
use App\Entity\Comments;
/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);

    	$serviciosD = $this->getDoctrine()->getRepository(Services::class);
    	$serviciosDestacados = $serviciosD->findByDestacados();
    	$serviciosN = $this->getDoctrine()->getRepository(Services::class);
    	$serviciosNuevos = $serviciosN->findByNovedad();

    	if (isset($session)){
    		$repository = $this->getDoctrine()->getRepository(User::class);
    		$user = $repository->findOneByEmail($session);
    		$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    		$commentSinRes = $comentarios->countCommentsAdmin(false);
    		$em = $this->getDoctrine()->getManager();
        	return $this->render('default/indexLogged.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'msj' => $commentSinRes[0][1],
        	'destacados' => $serviciosDestacados,
        	'novedad' => $serviciosNuevos]);
    	}
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig', [
        	'destacados' => $serviciosDestacados,
        	'novedad' => $serviciosNuevos]);
    }

    /**
     * @Route("/featured", name="featured")
     */
    public function featured(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);

    	$serviciosD = $this->getDoctrine()->getRepository(Services::class);
    	$serviciosDestacados = $serviciosD->findByAllDestacados();

    	$repository = $this->getDoctrine()->getRepository(User::class);
    	$user = $repository->findOneByEmail($session);

    	$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    	$commentSinRes = $comentarios->countCommentsAdmin(false);

    	$em = $this->getDoctrine()->getManager();
        return $this->render('default/featured.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'msj' => $commentSinRes[0][1],
        	'destacados' => $serviciosDestacados]);
    }

    /**
     * @Route("/addService", name="addService")
     */
    public function addService(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);

    	$repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneByEmail($session);

        $repCat = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $repCat->findAll();

        if(isset($_POST['createService'])){
        	$title=$_POST['title'];
        	$description=$_POST['description'];
        	$city=$user->getCity();
        	$moneyTime=$_POST['moneyTime'];
        	$cost=$_POST['moneyTime'];

        	if(isset($_FILES['image'])){
	            move_uploaded_file($_FILES['image']['tmp_name'], '../public/images/srvImg/'.$_FILES['image']['name']);
	            $image=$_FILES['image']['name'];
	        }

        	$catElegida = $this->getDoctrine()->getRepository(Categories::class);
        	$category = $catElegida->findOneByName($_POST['category']);


        	$nuevoServicio = new Services($title, $description, $image, $cost, true, false, $user, $city, $category, 0, null, false);
			$repositorio=$this->getDoctrine()->getManager();
			$repositorio->persist($nuevoServicio);
			$repositorio->flush();	
        	
        }

        $comentarios = $this->getDoctrine()->getRepository(Comments::class);
    	$commentSinRes = $comentarios->countCommentsAdmin(false);
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/addService.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'categorias' => $categories,
        	'msj' => $commentSinRes[0][1]]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);
    	$repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneByEmail($session);
        if(isset($_POST['aceptar'])){
    		$repositorioServicio = $this->getDoctrine()->getRepository(Services::class);
    		$servicio = $repositorioServicio->find($_POST['idServ']);

    		$servicio->setAccepted(true);
    		$aceptarServicio=$this->getDoctrine()->getManager();
			$aceptarServicio->persist($servicio);
			$aceptarServicio->flush();
    	}

    	if(isset($_POST['denegar'])){
    		$repositorioServicio = $this->getDoctrine()->getRepository(Services::class);
    		$servicio = $repositorioServicio->find($_POST['idServ']);

    		$servicio->setAvailability(true);
    		$servicio->setSolicitante(null);
    		$denegarServicio=$this->getDoctrine()->getManager();
			$denegarServicio->persist($servicio);
			$denegarServicio->flush();
    	}
        $servicios = $this->getDoctrine()->getRepository(Services::class);
    	$servicesAvailable = $servicios->findByAvailability(true, $user);
    	$servicesNotAvailable = $servicios->findByAvailableAndNotAccepted(false, $user, false);
    	$servicesAccepted = $servicios->findByAccepted(true, $user);
    	$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    	$commentSinRes = $comentarios->countCommentsAdmin(false);
    	
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/infoUser.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'serviciosD' => $servicesAvailable,
        	'serviciosA' => $servicesAccepted,
        	'serviciosND' => $servicesNotAvailable,
        	'msj' => $commentSinRes[0][1]
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);
    	if (isset($session)){
    		$repository = $this->getDoctrine()->getRepository(User::class);
    		$user = $repository->findOneByEmail($session);
    		$em = $this->getDoctrine()->getManager();
    		if(isset($_POST['sendComment'])){
    			$emisor=$user->getEmail();
    			$mensaje=$_POST['comentario'];

    			$nuevoMensaje = new Comments($emisor, $mensaje, 'admin@gmail.com', false);
    			$comentario=$this->getDoctrine()->getManager();
				$comentario->persist($nuevoMensaje);
				$comentario->flush();
    		}
    		$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    		$commentSinRes = $comentarios->countCommentsAdmin(false);

        	return $this->render('default/contactL.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'msj' => $commentSinRes[0][1]]);
    	}
    	if(isset($_POST['sendComment'])){
    		$emisor=$_POST['email'];
    		$mensaje=$_POST['comentario'];

    		$nuevoMensaje = new Comments($emisor, $mensaje, 'admin@gmail.com', false);
    		$comentario=$this->getDoctrine()->getManager();
			$comentario->persist($nuevoMensaje);
			$comentario->flush();
    	}
    	
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/adminPriv", name="adminPrivate")
     */
    public function adminP(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);
    	$repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneByEmail($session);
        if(isset($_POST['responder'])){
    		$comentarioLeido = $this->getDoctrine()->getRepository(Comments::class);
    		$comentario = $comentarioLeido->findOneById($_POST['receptor']);
    		$comentario->setRespondido(true);
    		$coment1=$this->getDoctrine()->getManager();
			$coment1->merge($comentario);
			$coment1->flush();

    		$receptorRespuesta=$comentario->getEmisor();
    		$mensaje=$_POST['respuesta'];

    		$nuevaRespuesta = new Comments('admin@gmail.com', $mensaje, $receptorRespuesta, true);
    		$coment=$this->getDoctrine()->getManager();
			$coment->persist($nuevaRespuesta);
			$coment->flush();
    	}
        $comentarios = $this->getDoctrine()->getRepository(Comments::class);
    	$commentRes = $comentarios->findByResInv(true);
    	$commentSinRes = $comentarios->findByRes(false);
    	$commentSinRes1 = $comentarios->countCommentsAdmin(false);
        $em = $this->getDoctrine()->getManager();
        return $this->render('admin/adminPrivate.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'comRespondidos' => $commentRes,
        	'comSinResponder' => $commentSinRes,
        	'msj' => $commentSinRes1[0][1]]);
    }

    /**
     * @Route("/service", name="service")
     */
    public function serviceInf(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);
    		$repository = $this->getDoctrine()->getRepository(User::class);
    		$user = $repository->findOneByEmail($session);

    		$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    		$commentSinRes = $comentarios->countCommentsAdmin(false);

    		$repositorioServicio = $this->getDoctrine()->getRepository(Services::class);
    		$servicio = $repositorioServicio->find($_POST['idServ']);

    		if(isset($_POST['contratado'])){
    			$servicio->setAvailability(false);
    			$servicio->setSolicitante($user);
    			$servicio->setNumSolicit($servicio->getNumSolicit()+1);
    			$pedirServicio=$this->getDoctrine()->getManager();
				$pedirServicio->persist($servicio);
				$pedirServicio->flush();

    		}

    		$em = $this->getDoctrine()->getManager();
        	return $this->render('default/infoServicio.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'msj' => $commentSinRes[0][1],
        	'servicio' => $servicio]);
    }
    
}