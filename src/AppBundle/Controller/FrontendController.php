<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Actividad;
use AppBundle\Entity\Proyecto;
use AppBundle\Entity\Respuesta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Empresa controller.
 *
 * @Route("/ticket")
 */
class FrontendController extends Controller
{
    /**
     * @Route("/", name="front_proyectos_list")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        /**
         * @var \UserBundle\Entity\User $user
         */
        $proyectos = $user->getProyectos();

        return $this->render('frontend/index.html.twig', array('proyectos' => $proyectos));
    }

    /**
     * @Route("/actividades/{proyecto}", name="fornt_actividades_list")
     */
    public function actividadesProyectoAction(Proyecto $proyecto)
    {
        $em = $this->getDoctrine()->getManager();

        $actividades = $em->getRepository('AppBundle:Actividad')->findByProyecto($proyecto);

        return $this->render('frontend/actividades.html.twig', array('actividades' => $actividades));

    }

    /**
     * @Route("/{actividad}/show", name="front_actividad_show")
     * @Method({"GET", "POST"})
     */
    public function actividadAction(Request $request, Actividad $actividad)
    {
        $respuesta = new Respuesta();
        $form = $this->createForm('AppBundle\Form\RespuestaType', $respuesta);
        $form->handleRequest($request);

        return $this->render('frontend/actividad.html.twig', array(
            'respuesta' => $respuesta,
            'actividad' => $actividad,
            'form' => $form->createView(),
        ));
    }
}
