<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespuestaRepository")
 */
class Respuesta
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $respuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Actividad", inversedBy="respuestas")
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id")
     **/
    private $actividad;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @param mixed $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * Set actividad
     *
     * @param \AppBundle\Entity\Actividad $actividad
     *
     * @return Respuesta
     */
    public function setActividad(\AppBundle\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return \AppBundle\Entity\Actividad
     */
    public function getActividad()
    {
        return $this->actividad;
    }
}
