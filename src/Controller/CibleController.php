<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Cible;

class CibleController extends AbstractController
{
    /**
     * Page Cible
     * 
     * Visualiser les cibles
     * 
     * @param int $id identifiant de la cible
     * 
     * @return Response
     */
    public function index(int $id): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupére la cible avec l'id 
        $cible = $em->getRepository(Cible::class)->findBy(['id' => $id]);

        return $this->render('cible/index.html.twig', [
            'cible' => $cible,
        ]);
    }

    /**
     * Création / Modification d'une cible
     * 
     * @param   int     $id     Identifiant de la cible
     * 
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        // Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Si un identifiant est présent dans l'url alors il s'agit d'une modification
        // Dans le cas contraire il s'agit d'une création de cible
        if ($id) {
            $mode = 'update';
            // On récupère la cible qui correspond à l'id passé dans l'url
            $cible = $em->getRepository(Cible::class)->findBy(['id' => $id]);
        } else {
            $mode       = 'new';
            $cible    = new Cible();
        }

        $form = $this->createForm(CibleType::class, $cible);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveCible($cible, $mode);
            return $this->redirectToRoute('cible_edit', array('id' => $cible->getId()));
        }
        $parameters = array(
            'form'      => $form->createView(),
            'cible'   => $cible,
            'mode'      => $mode
        );
        return $this->render('cible/edit.html.twig', $parameters);
    }
    /**
     * Supprimer la cible
     * 
     * @param   int     $id     Identifiant de la cible
     * 
     * @return Response
     */
    public function remove(int $id): Response
    {
        /// Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère la cible qui correspond à l'id passé dans l'URL
        $cible = $em->getRepository(Cible::class)->findBy(['id' => $id]);
        // La cible est supprimé
        $em->remove($cible);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Enregistrer une cible en base de données
     * 
     * @param   Cible     $cible
     * @param   string      $mode 
     */
    private function saveCible(Cible $cible, string $mode)
    {

        $em = $this->getDoctrine()->getManager();
        $em->persist($cible);
        $em->flush();
    }
}
