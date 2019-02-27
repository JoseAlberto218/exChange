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
    		$em = $this->getDoctrine()->getManager();
        	return $this->render('default/indexLogged.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user]);
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
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/infoUser.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'servicios' => $services]);
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


        	$nuevoServicio = new Services($title, $description, $image, $cost, true, false, $user, $city, $category);
			$repositorio=$this->getDoctrine()->getManager();
			$repositorio->persist($nuevoServicio);
			$repositorio->flush();	
        	
        }
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/addService.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user,
        	'categorias' => $categories]);
    }
    
}