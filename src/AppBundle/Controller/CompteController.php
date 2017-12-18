<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Compte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Compte controller.
 *
 * @Route("cp")
 */
class CompteController extends Controller
{
    /**
     * Lists all compte entities.
     *
     * @Route("/", name="cp_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comptes = $em->getRepository('AppBundle:Compte')->findAll();

        return $this->render('compte/index.html.twig', array(
            'comptes' => $comptes,
        ));
    }

    /**
     * Creates a new compte entity.
     *
     * @Route("/new", name="cp_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $compte = new Compte();
        $form = $this->createForm('AppBundle\Form\CompteType', $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compte);
            $em->flush();

            return $this->redirectToRoute('cp_show', array('id' => $compte->getId()));
        }

        return $this->render('compte/new.html.twig', array(
            'compte' => $compte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a compte entity.
     *
     * @Route("/{id}", name="cp_show")
     * @Method("GET")
     */
    public function showAction(Compte $compte)
    {
        $deleteForm = $this->createDeleteForm($compte);

        return $this->render('compte/show.html.twig', array(
            'compte' => $compte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing compte entity.
     *
     * @Route("/{id}/edit", name="cp_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Compte $compte)
    {
        $deleteForm = $this->createDeleteForm($compte);
        $editForm = $this->createForm('AppBundle\Form\CompteType', $compte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cp_edit', array('id' => $compte->getId()));
        }

        return $this->render('compte/edit.html.twig', array(
            'compte' => $compte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a compte entity.
     *
     * @Route("/{id}", name="cp_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Compte $compte)
    {
        $form = $this->createDeleteForm($compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($compte);
            $em->flush();
        }

        return $this->redirectToRoute('cp_index');
    }

    /**
     * Creates a form to delete a compte entity.
     *
     * @param Compte $compte The compte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Compte $compte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cp_delete', array('id' => $compte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
