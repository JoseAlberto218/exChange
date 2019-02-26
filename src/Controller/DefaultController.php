<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
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
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/infoUser.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user]);
    }

    /**
     * @Route("/addService", name="service")
     */
    public function profile(Request $request): Response
    {
    	$session=$request->getSession()->get(Security::LAST_USERNAME);
    	$repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneByEmail($session);
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/infoUser.html.twig', [
        	'controller_name'=>'DefaultController',
        	'usuario' => $user]);
    }
    
}