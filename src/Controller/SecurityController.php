<?php

namespace App\Controller;

use App\Entity\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
    	// get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();
	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();

	    return $this->render('security/login.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));
    }

    /**
     * @Route("/successAuth", name="successAuth")
     */
    public function successAuthAction()
    {
        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();
        
        $auth = new Auth();
        $auth->setUid($user->getId());
        
        $entityManager->persist($auth);
        $entityManager->flush();
        
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/login_check", name="_login_check")
     */
    public function securityCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
}