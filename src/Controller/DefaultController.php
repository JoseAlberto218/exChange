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
    	if (isset($session)){
    		$repository = $this->getDoctrine()->getRepository(User::class);
    		$user = $repository->findOneByEmail($session);
    		$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    		$commentSinRes = $comentarios->countCommentsAdmin(false);
    		$em = $this->getDoctrine()->getManager();
        	return $this->render('default/indexLogged.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'msj' => $commentSinRes[0][1]]);
    	}
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);
    	$repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneByEmail($session);
        $servicios = $this->getDoctrine()->getRepository(Services::class);
    	$services = $servicios->findAll();
    	$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    	$commentSinRes = $comentarios->countCommentsAdmin(false);
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/infoUser.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'servicios' => $services,
        	'msj' => $commentSinRes[0][1]]);
    }

    /**
     * @Route("/addService", name="service")
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


        	$nuevoServicio = new Services($title, $description, $image, $cost, true, false, $user, $city, $category, 0, null);
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
    	$comentarios = $this->getDoctrine()->getRepository(Comments::class);
    	$commentSinRes = $comentarios->countCommentsAdmin(false);
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
    
}