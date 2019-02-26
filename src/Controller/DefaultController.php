<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    		$em = $this->getDoctrine()->getManager();
        	return $this->render('default/indexLogged.html.twig');
    	}
        $em = $this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig');
    }

    
}