<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanqueController extends AbstractController
{
    /**
     * Page Planque
     * 
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('planque/index.html.twig', [
            'controller_name' => 'PlanqueController',
        ]);
    }
}
