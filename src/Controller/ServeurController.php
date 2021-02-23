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
     * @Route("/formulaire1", name="formulaire1")
     */
    public function formulaire(): Response
    {
        return $this->render('formulaire1/formulaire.html.twig', [
            'controller_name' => 'formulaireController',
        ]);
    }
	
	/**
     * @Route("/formulaire2", name="formulaire2")
     */
    public function utilisateur(): Response
    {
        return $this->render('formulaire2/utilisateur.html.twig', [
            'controller_name' => 'utilisateurController',
        ]);
    }
}
