<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Actividad
 *
 * @ORM\Table(name="actividad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActividadRepository")
 */
class Actividad
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
     * @ORM\Column(name="estado", type="string", length=50)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text")
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=50)
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Proyecto", inversedBy="actividades")
     * @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
     **/
    private $proyecto;

    /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="actividad")
     *
     */
    private $respuestas;

    public function __construct()
    {
        $this->respuestas = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Actividad
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Actividad
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Actividad
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set proyecto
     *
     * @param \AppBundle\Entity\Proyecto $proyecto
     *
     * @return Actividad
     */
    public function setProyecto(\AppBundle\Entity\Proyecto $proyecto = null)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return \AppBundle\Entity\Proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Add respuesta
     *
     * @param \AppBundle\Entity\Respuesta $respuesta
     *
     * @return Actividad
     */
    public function addRespuesta(\AppBundle\Entity\Respuesta $respuesta)
    {
        $this->respuestas[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \AppBundle\Entity\Respuesta $respuesta
     */
    public function removeRespuesta(\AppBundle\Entity\Respuesta $respuesta)
    {
        $this->respuestas->removeElement($respuesta);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }
}
