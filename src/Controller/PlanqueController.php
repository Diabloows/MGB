<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Planque;

class PlanqueController extends AbstractController
{
    /**
     * Page Planque
     * 
     * Visualiser les planque
     * 
     * @param int $id identifiant de la planque
     * 
     * @return Response
     */
    public function index(int $id): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupére la planque avec l'id 
        $planque = $em->getRepository(Planque::class)->findBy(['id' => $id]);

        return $this->render('planque/index.html.twig', [
            'planque' => $planque,
        ]);
    }

    /**
     * Création / Modification d'une planque
     * 
     * @param   int     $id     Identifiant de la planque
     * 
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        // Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Si un identifiant est présent dans l'url alors il s'agit d'une modification
        // Dans le cas contraire il s'agit d'une création de planque
        if ($id) {
            $mode = 'update';
            // On récupère la planque qui correspond à l'id passé dans l'url
            $planque = $em->getRepository(Planque::class)->findBy(['id' => $id]);
        } else {
            $mode       = 'new';
            $planque   = new Planque();
        }

        $form = $this->createForm(PlanqueType::class, $planque);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->savePlanque($planque, $mode);
            return $this->redirectToRoute('planque_edit', array('id' => $planque->getId()));
        }
        $parameters = array(
            'form'      => $form->createView(),
            'planque'   => $planque,
            'mode'      => $mode
        );
        return $this->render('planque/edit.html.twig', $parameters);
    }
    /**
     * Supprimer la planque
     * 
     * @param   int     $id     Identifiant de la planque
     * 
     * @return Response
     */
    public function remove(int $id): Response
    {
        /// Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère la planque qui correspond à l'id passé dans l'URL
        $planque = $em->getRepository(Planque::class)->findBy(['id' => $id]);
        // La planque est supprimé
        $em->remove($planque);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Enregistrer une planque en base de données
     * 
     * @param   Planque     $planque
     * @param   string      $mode 
     */
    private function savePlanque(Planque $planque, string $mode)
    {

        $em = $this->getDoctrine()->getManager();
        $em->persist($planque);
        $em->flush();
    }
}
