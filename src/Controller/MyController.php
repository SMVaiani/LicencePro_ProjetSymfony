<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EnchereRepository;
use App\Entity\HistoriqueEncheres;

class MyController extends AbstractController
{
	 /**
	  * @Route("/", name="index")
	  */
	public function index(EnchereRepository $enchereRepository):Response
	{
		if($this->getUser() != null)
		{
			$user = $this->getUser();
			$achats = $user->getAchat();
			$nbJetons = 0;
			foreach($achats as $achat)
			{
				$packJetons = $achat->getPackjetons();
				$nbJetons += $packJetons->getNbjetons();
			}
			
			$nbJetons -= count($user->getHistoriqueEncheres());
			return $this->render('index.html.twig', [
			'encheres' => $enchereRepository->findAll(),
			'nbJetons' => $nbJetons,
		]);
		}
		
		return $this->render('index.html.twig', [
			'encheres' => $enchereRepository->findAll(),
		]);
	}	 
	
	/**
	  * @Route("/utilisateur/placer", name="utilisateur_placer", methods={"GET","POST"})
	  */
	public function placerOffre(EnchereRepository $enchereRepository):Response
	{
		if(isset($_POST['mise']) && isset($_POST['id_enchere']) && !empty($_POST['mise']) && $this->getUser() != null)
		{
			$mise = $_POST['mise'];
			$id_enchere = $_POST['id_enchere'];
			$user = $this->getUser();
			$achats = $user->getAchat();
			$nbJetons = 0;
			foreach($achats as $achat)
			{
				$packJetons = $achat->getPackjetons();
				$nbJetons += $packJetons->getNbjetons();
			}
			
			if($nbJetons > count($user->getHistoriqueEncheres()))
			{
				$enchere = $enchereRepository->find($id_enchere);
				$historiqueEncheres = new HistoriqueEncheres();
				$historiqueEncheres->setEnchere($enchere);
				$historiqueEncheres->setPrix($mise);
				$user->addHistoriqueEnchere($historiqueEncheres);
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($historiqueEncheres);
				$entityManager->flush();
			}
			else {
				
			}
			
		}
		else {
			return $this->redirectToRoute('app_login');
		}
		
		return $this->redirectToRoute('index');
	}
}