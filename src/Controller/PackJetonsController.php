<?php

namespace App\Controller;

use App\Entity\PackJetons;
use App\Entity\Utilisateur;
use App\Entity\Achat;
use App\Form\PackJetonsType;
use App\Repository\PackJetonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jetons")
 */
class PackJetonsController extends AbstractController
{
    /**
     * @Route("/", name="pack_jetons_index")
     */
    public function index(PackJetonsRepository $packJetonsRepository): Response
    {
        return $this->render('pack_jetons/index.html.twig', [
            'pack_jetons' => $packJetonsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/acheter", name="utilisateur_acheter", methods={"GET","POST"})
     */
    public function new(Request $request, PackJetonsRepository $packJetonsRepository): Response
    {
		if (isset($_POST['choix_id_jetons'])) {
			$idJeton = $_POST['choix_id_jetons'];
			$achat = new Achat();
			$packJeton = $packJetonsRepository->find($idJeton);
			$packJeton->addAchat($achat);
			$this->getUser()->addAchat($achat);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($achat);
			$entityManager->flush();
		}

		return $this->redirectToRoute('pack_jetons_index');
    }
}
