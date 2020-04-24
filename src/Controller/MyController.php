<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EnchereRepository;

class MyController extends AbstractController
{
	 /**
	  * @Route("/", name="index")
	  */
	public function index(EnchereRepository $enchereRepository):Response
	{
		return $this->render('index.html.twig', [
			'encheres' => $enchereRepository->findAll(),
		]);
	}
}