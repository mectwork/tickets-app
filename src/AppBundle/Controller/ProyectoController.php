<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Empresa;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Proyecto;

/**
 * Proyecto controller.
 *
 * @Route("/proyecto")
 */
class ProyectoController extends Controller
{
    /**
     * Lists all Proyecto entities.
     *
     * @Route("/", name="proyecto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $proyectos = $em->getRepository('AppBundle:Proyecto')->findAll();

        return $this->render('proyecto/index.html.twig', array(
            'proyectos' => $proyectos,
        ));
    }

    /**
     * Creates a new Proyecto entity.
     *
     * @Route("/new", name="proyecto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $proyecto = new Proyecto();
        $form = $this->createForm('AppBundle\Form\ProyectoType', $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proyecto);
            $em->flush();

            return $this->redirectToRoute('proyecto_show', array('id' => $proyecto->getId()));
        }

        return $this->render('proyecto/new.html.twig', array(
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proyecto entity.
     *
     * @Route("/{id}", name="proyecto_show")
     * @Method("GET")
     */
    public function showAction(Proyecto $proyecto)
    {
        $deleteForm = $this->createDeleteForm($proyecto);

        return $this->render('proyecto/show.html.twig', array(
            'proyecto' => $proyecto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proyecto entity.
     *
     * @Route("/{id}/edit", name="proyecto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proyecto $proyecto)
    {
        $deleteForm = $this->createDeleteForm($proyecto);
        $editForm = $this->createForm('AppBundle\Form\ProyectoType', $proyecto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proyecto);
            $em->flush();

            return $this->redirectToRoute('proyecto_edit', array('id' => $proyecto->getId()));
        }

        return $this->render('proyecto/edit.html.twig', array(
            'proyecto' => $proyecto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proyecto entity.
     *
     * @Route("/{id}", name="proyecto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Proyecto $proyecto)
    {
        $form = $this->createDeleteForm($proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proyecto);
            $em->flush();
        }

        return $this->redirectToRoute('proyecto_index');
    }

    /**
     * Creates a form to delete a Proyecto entity.
     *
     * @param Proyecto $proyecto The Proyecto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proyecto $proyecto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proyecto_delete', array('id' => $proyecto->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Fastest Deleted of a Proyecto.
     *
     * @Route("/{id}/delete", name="proyecto_fastest_delete")
     * @Method({"GET", "POST"})
     */
    public function fastestDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $proyecto = $em->getRepository('AppBundle:Proyecto')->find($id);

        /**
         * @var Proyecto $proyecto
         */
        $nombre = $proyecto->getNombre();

        $em->remove($proyecto);
        $em->flush();

        # Añadido mensaje flash
        $this->addFlash(
            'deleted',
            'Se ha borrado el Proyecto: ' . $nombre);

        return $this->redirectToRoute('proyecto_index');
    }

    /**
     * @Route("/{id}/get-proyectos", name="get_proyectos", options={"expose": true})
     * @Method("GET")
     *
     * @param Empresa $empresa
     * @return JsonResponse
     */
    public function getProyectosAction(Empresa $empresa)
    {
        $proyectos = $empresa->getProyectos();

        $array = array();
        foreach ($proyectos as $proyecto) {
            /** @var \AppBundle\Entity\Proyecto $proyecto */
            $array[] = array(
                'id' => $proyecto->getId(),
                'nombre' => $proyecto->getNombre(),
            );
        }

        if (count($array) === 0) {
            $array[] = array(
                'id' => '',
                'nombre' => 'No existen proyectos para la empresa seleccionada.'
            );
        }

        return new JsonResponse($array);
    }
}
