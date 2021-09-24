<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Mission;

class MissionController extends AbstractController
{
    /**
     * Page Mission
     * 
     * Visualiser la mission
     * 
     * @param int $id identifiant de la mission
     * 
     * @return Response
     */
    public function index(int $id): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupére la mission avec l'id 
        $mission = $em->getRepository(Mission::class)->findBy(['id'=> $id]);

        return $this->render('mission/index.html.twig', [
            'mission' => $mission,
        ]);
    }

    /**
     * Création / Modification d'une mission
     * 
     * @param   int     $id     Identifiant de la mission
     * 
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        // Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Si un identifiant est présent dans l'url alors il s'agit d'une modification
        // Dans le cas contraire il s'agit d'une création d'article
        if ($id) {
            $mode = 'update';
            // On récupère la mission qui correspond à l'id passé dans l'url
            $mission = $em->getRepository(Mission::class)->findBy(['id' => $id]);
        } else {
            $mode       = 'new';
            $mission    = new Mission();
        }
        
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveMission($mission, $mode);
            return $this->redirectToRoute('mission_edit', array('id' => $mission->getId()));
        }
        $parameters = array(
            'form'      => $form->createView(),
            'mission'   => $mission,
            'mode'      => $mode
        );
        return $this->render('mission/edit.html.twig', $parameters);
    }
    /**
     * Supprimer la mission
     * 
     * @param   int     $id     Identifiant de la mission
     * 
     * @return Response
     */
    public function remove(int $id): Response
    {
        /// Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère la mission qui correspond à l'id passé dans l'URL
        $mission = $em->getRepository(Mission::class)->findBy(['id' => $id]);
        // La mission est supprimée
        $em->remove($mission);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }
   
    /**
     * Enregistrer une mission en base de données
     * 
     * @param   Mission     $mission
     * @param   string      $mode 
     */
    private function saveMission(Mission $mission, string $mode){

        $em = $this->getDoctrine()->getManager();
        $em->persist($mission);
        $em->flush();
    }

}
