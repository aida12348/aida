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
	

   /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur(): Response
    {
        return $this->render('serveur/utilisateur.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
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
	/*$Adresse=$request->request->get("Adresse");
	$Datedenaissance=$request->request->get("Datedenaissance");
	$formation=$request->request->get("formation");*/
	 $utilisateur -> setNom($Nom);
	 $utilisateur -> setPrénom($Prénom);
	 $utilisateur -> setEmail($Prénom);
	 $utilisateur -> setmotdepasse($motdepasse);
	 /*$utilisateur -> setAdresse($Adresse);
     $utilisateur -> setdaDatedenaissance($Datedenaissance);
	 $utilisateur -> setformation($formation);*/

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
	
	$nom=$request->request->get("nom");
	$prénom=$request->request->get("prénom");
	$téléphone=$request->request->get("téléphone");
	$Adresse=$request->request->get("Adresse");
	$Datedenaissance=$request->request->get("Datedenaissance");
	$formation=$request->request->get("formation");
	
	
	}
	/**
     * @Route("/connexion", name="connexion")
     */
	 
   /* public function connexion(Request $request, EntityManagerInterface $manager)
    {
		
		$name = $request->request->get("name");
		$password = $request->request->get("password");
		
		//on selectionne dans la base de données
		
		$aUser = $manager -> getRepository(Utilisateur::class)->findBy(["name"=>$name,"password"=>$password]);
		
		//on teste le résultat
		
		if(sizeof($aUser)==1) {
			
			$utilisateur = new Utilisateur();
			$utilisateur = $aUser[0];
			
			//on demarre la session
			
			$session = $request->getSession();
			
			//on met à jour les variables de session
			
			$session -> set("idUtilisateur",$utilisateur -> getID());
			$session -> set("nameUtilisateur",$utilisateur -> getname());
			$session -> set("passwordUtilisateur",$utilisateur -> getpassword());
			$session -> set("EmailUtilisateur",$utilisateur -> getEmail());
			
			return $this->redirectToRoute('serveur');
			return $this->render('serveur/login.html.twig');
		}*/
			
			
			
	/*$utilisateur = $manager -> getRepository(utilisateur::class)->findOneByPrenomNom($prénom,$nom);
	// verifier le mot de passe 
	
	if ($utilisateur == null){
		return new reponse("utilisateur".$prénom."".$nom." Inconnu");
		$session -> set('Nom,prénom',-1);
	}
	else 
	if (password_verify($password,$utilisateur->getCode())== false) {
		$session -> set('password',-1);
		return new reponse ("Mot de passe incorrect");
	}
	else {
		$session -> set('userId',$utilisateur->getId());
		return $this ->redirectToRoute ('serveur');

	
    }}*/
	
	
	 /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request,EntityManagerInterface
	$manager, SessionInterface $session): Response
    
    {
		$session=$request -> getsession();
        $session -> clear ();
		return $this ->redirectToRoute ('serveur');

    }
	/**
     * @Route("/AjouterFichier", name="Ajouter_Fichier")
     */
   /* public function AjouterFichier(EntityManagerInterface
	$manager, SessionInterface $session): Response
    { 
	
	if ($utilisateur) {
		
	$AjouterFichier=$manager->getRepository(Utilisateur::class)->findAll();
	
    
        return $this->render('serveur/fichier.html.twig',['utilisateur' => $utilisateur]);
	
	}
	else
		 return new response("cette page est réservée aux utilisateurs.");


	}*/
}
