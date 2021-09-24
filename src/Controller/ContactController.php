<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Contact;

class ContactController extends AbstractController
{
    /**
     * Page Contact
     * 
     * Visualiser les contact
     * 
     * @param int $id identifiant de la contact
     * 
     * @return Response
     */
    public function index(int $id): Response
    {
        //Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupére la contact avec l'id 
        $contact = $em->getRepository(Contact::class)->findBy(['id' => $id]);

        return $this->render('contact/index.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * Création / Modification d'une contact
     * 
     * @param   int     $id     Identifiant de la contact
     * 
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        // Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Si un identifiant est présent dans l'url alors il s'agit d'une modification
        // Dans le cas contraire il s'agit d'une création de contact
        if ($id) {
            $mode = 'update';
            // On récupère la contact qui correspond à l'id passé dans l'url
            $contact = $em->getRepository(Contact::class)->findBy(['id' => $id]);
        } else {
            $mode       = 'new';
            $contact    = new Contact();
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveContact($contact, $mode);
            return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
        }
        $parameters = array(
            'form'      => $form->createView(),
            'contact'   => $contact,
            'mode'      => $mode
        );
        return $this->render('contact/edit.html.twig', $parameters);
    }
    /**
     * Supprimer la contact
     * 
     * @param   int     $id     Identifiant de la contact
     * 
     * @return Response
     */
    public function remove(int $id): Response
    {
        /// Entity Manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère la contact qui correspond à l'id passé dans l'URL
        $contact = $em->getRepository(Contact::class)->findBy(['id' => $id]);
        // La contact est supprimé
        $em->remove($contact);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Enregistrer une contact en base de données
     * 
     * @param   Contact     $contact
     * @param   string      $mode 
     */
    private function saveContact(Contact $contact, string $mode)
    {

        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
    }
}
