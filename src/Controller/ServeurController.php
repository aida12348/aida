<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;

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
	$login=$request->request->get("name");
	$password=$request->request->get("password");
	
	if ($login=="admin")
		$message="bienvenu admin";
	else 
		$message="vous etes simple utilisateur";

        return $this->render('login/index.html.twig', [
            'name' => $login,'message' => $message
        ]);
    }
	

   
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur(Request $request,EntityManagerInterface
	$manager): Response
	$monUtilisateur = new Utilisateur();
	 $monUtilisateur -> setNom($nom);
	 $monUtilisateur -> setPrénom($prénom);
	 $monUtilisateur -> setTéléphone($téléphone);
	 $monUtilisateur -> setAdresse($Adresse);
	 $monUtilisateur -> setDatedenaissance($Datedenaissance);
	 $monUtilisateur -> setFormation($formation);
	
	 $manager -> persist($monUtilisateur);

    $manager -> flush ();
	return $this->redirectToRoute ('utilisateur');
	
    /*{
		
        return $this->render('serveur/utilisateur.html.twig', [
            'controller_name' => 'utilisateurController',
        ]);
    }*/
	
	/**
     * @Route("/ListeUtilisateurs", name="Liste_Utilisateurs")
     */
    public function index(EntityManagerInterface
	$manager): Response
	$mesUtilisateurs=$manager->getRepository(Utilisateur::class)->findAll();
    {
        return $this->render('serveur/liste_utilisateurs.html.twig',['utilisateurs' => $mesUtilisateurs]);
        ]);
    }
	
	
}
