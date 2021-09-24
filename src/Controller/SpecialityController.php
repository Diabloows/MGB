<?php

namespace App\Controller;

use App\Entity\Speciality;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SpecialityController extends AbstractController
{
    /**
     * Page Speciality
     * 
     * Visualiser les speciality
     * 
     * @param int $id identifiant de la speciality
     * 
     * @return Response
     */
    public function index(int $id): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupére la speciality avec l'id 
        $speciality = $em->getRepository(Speciality::class)->findBy(['id' => $id]);

        return $this->render('speciality/index.html.twig', [
            'speciality' => $speciality,
        ]);
    }

    /**
     * Création / Modification d'une speciality
     * 
     * @param   int     $id     Identifiant de la speciality
     * 
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        // Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Si un identifiant est présent dans l'url alors il s'agit d'une modification
        // Dans le cas contraire il s'agit d'une création de speciality
        if ($id) {
            $mode = 'update';
            // On récupère la speciality qui correspond à l'id passé dans l'url
            $speciality = $em->getRepository(Speciality::class)->findBy(['id' => $id]);
        } else {
            $mode       = 'new';
            $speciality    = new Speciality();
        }

        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveSpeciality($speciality, $mode);
            return $this->redirectToRoute('speciality_edit', array('id' => $speciality->getId()));
        }
        $parameters = array(
            'form'      => $form->createView(),
            'speciality'   => $speciality,
            'mode'      => $mode
        );
        return $this->render('speciality/edit.html.twig', $parameters);
    }
    /**
     * Supprimer la speciality
     * 
     * @param   int     $id     Identifiant de la speciality
     * 
     * @return Response
     */
    public function remove(int $id): Response
    {
        /// Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère la speciality qui correspond à l'id passé dans l'URL
        $speciality = $em->getRepository(Speciality::class)->findBy(['id' => $id]);
        // La speciality est supprimé
        $em->remove($speciality);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Enregistrer une speciality en base de données
     * 
     * @param   Speciality     $speciality
     * @param   string      $mode 
     */
    private function saveSpeciality(Speciality $speciality, string $mode)
    {

        $em = $this->getDoctrine()->getManager();
        $em->persist($speciality);
        $em->flush();
    }
}
