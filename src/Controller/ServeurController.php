<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServeurController extends AbstractController
{
    /**
     * @Route("/serveur", name="serveur")
     */
    public function index(): Response
    {
        return $this->render('serveur/index.html.twig', [
            'controller_name' => 'ServeurController',
        ]);
    }
	 /**
     * @Route("/login", name="create_login")
     */
    public function createlogin(Request $request,EntityManagerInterface
	$manager): Response
    { 
	$login = new login();
	$login=$request->request->get("name");
	$login->setlogin($name);
	$manager->persist($login);
	$manager->flush();
        return $this->render('login/index.html.twig', [
            'name' => 'messsage',
        ]);
    }
	

    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function formulaire(): Response
    { 
        return $this->render('serveur/formulaire.html.twig', [
            'controller_name' => 'formulaireController',
        ]);
    }

    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur(): Response
    {
        return $this->render('serveur/utilisateur.html.twig', [
            'controller_name' => 'utilisateurController',
        ]);
    }
	
	
}
