<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Mission;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     * 
     * @return Response
     */
    public function index(): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Affiche toutes les missions
        $mission = $em->getRepository(Mission::class)->findAll();

        return $this->render('home/index.html.twig', [
            'missions' => $mission,
        ]);
    }
}
