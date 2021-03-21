<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
	{ 
	$nom=$request->request->get("nom");
	$prénom=$request->request->get("prénom");
	$téléphone=$request->request->get("téléphone");
	$Adresse=$request->request->get("Adresse");
	$Datedenaissance=$request->request->get("Datedenaissance");
	$formation=$request->request->get("formation");
	
	
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
	}
	
    /*{
		
        return $this->render('serveur/utilisateur.html.twig', [
            'controller_name' => 'utilisateurController',
        ]);
    }*/
	
	/**
     * @Route("/Listeu", name="Liste_u")
     */
    public function Liste_u(EntityManagerInterface
	$manager): Response
	{
	$mesUtilisateurs=$manager->getRepository(Utilisateur::class)->findAll();
    
        return $this->render('serveur/liste_utilisateurs.html.twig',['utilisateurs' => $mesUtilisateurs]);
        
    }
	
	 /**
     * @Route("/session", name="create_session")
     */
    public function createsession(Request $request,EntityManagerInterface
	$manager, SessionInterface $session): Response
    { 
	
	$nom=$request->request->get("nom");
	$prénom=$request->request->get("prénom");
	$téléphone=$request->request->get("téléphone");
	$Adresse=$request->request->get("Adresse");
	$Datedenaissance=$request->request->get("Datedenaissance");
	$formation=$request->request->get("formation");
	
	
	
	$utilisateur = $manager -> getRepository(Utilisateur::class)->findOneByPrenomNom($prénom,$nom);
	// verifier le mot de passe 
	
	if ($utilisateur == null){
		return new reponse("utilisateur".$prénom."".$nom." Inconnu");
		$session -> set('userId',-1);
	}
	else 
	if (password_verify($motdepasse,$utilisateur->getCode())== false) {
		$session -> set('userId',-1);
		return new reponse ("Mot de passe incorrect");
	}
	else {
		$session -> set('userId',$utilisateur->getId());
		return $this ->redirectToRoute ('serveur');

	
    }}
	
	
	 /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function session(Request $request,EntityManagerInterface
	$manager, SessionInterface $session): Response
    
    {
        $session -> clear ();
		return $this ->redirectToRoute ('serveur');

    }
}
