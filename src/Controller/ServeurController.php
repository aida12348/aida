<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Entity\Acces;
use App\Entity\Document;
use App\Entity\Autorisation;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ServeurController extends AbstractController
{
	//creation de formulaire
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
    public function createlogin(Request $request,EntityManagerInterface $manager): Response
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
	
    //creation d'utilisateur
   /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur(): Response
    {
        return $this->render('serveur/utilisateur.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
	// mise a jour de la base de donnée
    /**
     * @Route("/createUtilisateur", name="create_Utilisateur")
     */
    public function createUtilisateur(Request $request,EntityManagerInterface
	$manager): Response
	{ 
	
	 $utilisateur = new Utilisateur();
	 $Nom=$request->request->get("Nom");
	$Prénom=$request->request->get("prénom");
	$motdepasse=$request->request->get("motdepasse");
	
	 $utilisateur -> setNom($Nom);
	 $utilisateur -> setPrénom($Prénom);
	 $utilisateur -> setEmail($Prénom);
	 $utilisateur -> setmotdepasse($motdepasse);
	 

	 $manager -> persist($utilisateur);
    $manager -> flush ();
	return $this->redirectToRoute ('Liste_utilisateur');
	}
	
    
	
	/**
     * @Route("/ListeUtilisateur", name="Liste_utilisateur")
     */
    public function ListeUtilisateur(Request $request,EntityManagerInterface
	$manager): Response
	{
	$ListeUtilisateurs=$manager->getRepository(Utilisateur::class)->findAll();
	
    
        return $this->render('serveur/Liste_utilisateurs.html.twig',['ListeUtilisateurs' => $ListeUtilisateurs]);
        
    }
	
	 /**
     * @Route("/session", name="session")
     */
    public function session(Request $request,EntityManagerInterface
	$manager, SessionInterface $session): Response
    { 
	
	$nom=$request->request->get("Nom");
	$prénom=$request->request->get("Prénom");
	$motdepasse=$request->request->get("motdepasse");
	$Email=$request->request->get("Email");
	
	$utilisateur = $manager -> getRepository(Utilisateur::class)->findOneByPrénomNom($Prénom,$Nom);
	// verifier le mot de passe 
	
	if ($utilisateur == null){
		return new reponse("utilisateur".$Prénom."".$Nom." Inconnu");
		$session -> set('Nom,Prénom',-1);
	}
	else 
	if (password_verify($password,$utilisateur->getpassword())== false) {
		$session -> set('password',-1);
		return new reponse ("Mot de passe invalide");
	}
	else {
		$session -> set('id',$utilisateur->getId());
		return $this ->redirectToRoute ('serveur');

	
    }
	}
	
			
	 //se deconnecter
	
	 /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request,EntityManagerInterface
	$manager, SessionInterface $session): Response
    
    {
		$session=$request -> getsession();
        $session -> clear ();
		$session->remove("idUtilisateur");
		$session->invalidate();
		$session=$request->getSession()->clear();
		return $this->redirectToRoute('serveur');
    }
	// Ajout de fichier
	/**
     * @Route("/AjouterFichier", name="Ajouter_Fichier")
     */
     
    public function AjouterFichier(Request $request, EntityManagerInterface $manager): Response
    {
        
        return $this->render('serveur/fichier.html.twig', [
        'controller_name' => "fichier controller",
        
        'listeUtilisateurs' => $manager->getRepository(Utilisateur::class)->findAll(),
       
        ]);
    }
	
	// creation liste utilisateur 
	/**
     * @Route("/ListeFichier", name="Liste_Fichier")
     */
    public function ListeFichier(Request $request,EntityManagerInterface
	$manager): Response
	{
	$ListeFichier=$manager->getRepository(document::class)->findAll();
	
    
        return $this->render('serveur/Liste_Fichier.html.twig',['ListeFichier' => $ListeFichier]);
        
    }
}
