<?php

namespace App\Controller;

use App\Entity\Speciality;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SpecialityController extends AbstractController
{
    /**
     * Page Speciality
     * 
     * @return Response
     */
    public function index(): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Affiche toutes les specialités en bdd
        $speciality = $em->getRepository(Speciality::class)->findAll();

        return $this->render('speciality/index.html.twig', [
            'specialité' => $speciality,
        ]);
    }
}
