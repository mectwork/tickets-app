<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Respuesta;
use AppBundle\Form\RespuestaType;

/**
 * Respuesta controller.
 *
 * @Route("/respuesta")
 */
class RespuestaController extends Controller
{
    /**
     * Lists all Respuesta entities.
     *
     * @Route("/", name="respuesta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $respuestas = $em->getRepository('AppBundle:Respuesta')->findAll();

        return $this->render('respuesta/index.html.twig', array(
            'respuestas' => $respuestas,
        ));
    }

    /**
     * Creates a new Respuesta entity.
     *
     * @Route("/new", name="respuesta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $respuestum = new Respuesta();
        $form = $this->createForm('AppBundle\Form\RespuestaType', $respuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($respuestum);
            $em->flush();

            return $this->redirectToRoute('respuesta_show', array('id' => $respuestum->getId()));
        }

        return $this->render('respuesta/new.html.twig', array(
            'respuestum' => $respuestum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Respuesta entity.
     *
     * @Route("/{id}", name="respuesta_show")
     * @Method("GET")
     */
    public function showAction(Respuesta $respuestum)
    {
        $deleteForm = $this->createDeleteForm($respuestum);

        return $this->render('respuesta/show.html.twig', array(
            'respuestum' => $respuestum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Respuesta entity.
     *
     * @Route("/{id}/edit", name="respuesta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Respuesta $respuestum)
    {
        $deleteForm = $this->createDeleteForm($respuestum);
        $editForm = $this->createForm('AppBundle\Form\RespuestaType', $respuestum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($respuestum);
            $em->flush();

            return $this->redirectToRoute('respuesta_edit', array('id' => $respuestum->getId()));
        }

        return $this->render('respuesta/edit.html.twig', array(
            'respuestum' => $respuestum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Respuesta entity.
     *
     * @Route("/{id}", name="respuesta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Respuesta $respuestum)
    {
        $form = $this->createDeleteForm($respuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($respuestum);
            $em->flush();
        }

        return $this->redirectToRoute('respuesta_index');
    }

    /**
     * Creates a form to delete a Respuesta entity.
     *
     * @param Respuesta $respuestum The Respuesta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Respuesta $respuestum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('respuesta_delete', array('id' => $respuestum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
