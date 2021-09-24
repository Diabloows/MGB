<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Agent;

class AgentController extends AbstractController
{
    /**
     * Page Agent
     * 
     * Visualiser les agents
     * 
     * @param int $id identifiant de l'agent
     * 
     * @return Response
     */
    public function index(int $id): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupére l'agent avec l'id 
        $agent = $em->getRepository(Agent::class)->findBy(['id' => $id]);

        return $this->render('agent/index.html.twig', [
            'agent' => $agent,
        ]);
    }

    /**
     * Création / Modification d'un agent
     * 
     * @param   int     $id     Identifiant de l'agent
     * 
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        // Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Si un identifiant est présent dans l'url alors il s'agit d'une modification
        // Dans le cas contraire il s'agit d'une création d'agent
        if ($id) {
            $mode = 'update';
            // On récupère lagent qui correspond à l'id passé dans l'url
            $agent = $em->getRepository(Agent::class)->findBy(['id' => $id]);
        } else {
            $mode       = 'new';
            $agent    = new Agent();
        }

        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveAgent($agent, $mode);
            return $this->redirectToRoute('agent_edit', array('id' => $agent->getId()));
        }
        $parameters = array(
            'form'      => $form->createView(),
            'agent'   => $agent,
            'mode'      => $mode
        );
        return $this->render('agent/edit.html.twig', $parameters);
    }
    /**
     * Supprimer la agent
     * 
     * @param   int     $id     Identifiant de la agent
     * 
     * @return Response
     */
    public function remove(int $id): Response
    {
        /// Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère lagent qui correspond à l'id passé dans l'URL
        $agent = $em->getRepository(Agent::class)->findBy(['id' => $id]);
        // Lagent est supprimé
        $em->remove($agent);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Enregistrer un agent en base de données
     * 
     * @param   Agent     $agent
     * @param   string      $mode 
     */
    private function saveAgent(Agent $agent, string $mode)
    {

        $em = $this->getDoctrine()->getManager();
        $em->persist($agent);
        $em->flush();
    }
}
