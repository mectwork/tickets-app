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
     * @Route("/actividades_proyecto/{proyecto}", name="front_actividades_list")
     */
    public function actividadesProyectoAction(Proyecto $proyecto)
    {
        $em = $this->getDoctrine()->getManager();

        $actividades = $em->getRepository('AppBundle:Actividad')->findByProyecto($proyecto);

        return $this->render('frontend/actividades.html.twig', array('actividades' => $actividades));

    }

    /**
     * @Route("/actividad/{actividad}/show", name="front_actividad_show")
     * @Method({"GET", "POST"})
     */
    public function actividadAction(Request $request, Actividad $actividad)
    {
        $respuesta = new Respuesta();
        $form = $this->createForm('AppBundle\Form\RespuestaType', $respuesta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $respuesta->setActividad($actividad);
            $em->persist($respuesta);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('info@tickets.com')
                ->setTo('mano@correo.com')
                ->setBody('Se ha creado un nuevo comentario para: '
                    . $actividad->getTitulo()
                    . ' del proyecto: '
                    . $actividad->getProyecto()->getNombre());
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('front_actividad_show', array('actividad' => $actividad->getId()));
        }
        return $this->render('frontend/actividad.html.twig', array(
            'respuesta' => $respuesta,
            'actividad' => $actividad,
            'form' => $form->createView(),
        ));
    }
}
