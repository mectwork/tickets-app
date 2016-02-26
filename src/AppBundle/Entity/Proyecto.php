<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto
 *
 * @ORM\Table(name="proyecto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProyectoRepository")
 */
class Proyecto
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="proyectos")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $empresa;

    /**
     * @ORM\ManyToMany(targetEntity="\UserBundle\Entity\User", mappedBy="proyectos")
     */
    private $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="Actividad", mappedBy="proyecto")
     *
     */
    private $actividades;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return strval($this->nombre);
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Proyecto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Proyecto
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Add usuario
     *
     * @param \UserBundle\Entity\User $usuario
     *
     * @return Proyecto
     */
    public function addUsuario(\UserBundle\Entity\User $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \UserBundle\Entity\User $usuario
     */
    public function removeUsuario(\UserBundle\Entity\User $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * @param mixed $actividades
     */
    public function setActividades($actividades)
    {
        $this->actividades = $actividades;
    }

    /**
     * Add actividad
     *
     * @param \AppBundle\Entity\Actividad $actividad
     *
     * @return Proyecto
     */
    public function addActividade(\AppBundle\Entity\Actividad $actividad)
    {
        $this->actividades[] = $actividad;

        return $this;
    }

    /**
     * Remove actividad
     *
     * @param \AppBundle\Entity\Actividad $actividad
     */
    public function removeActividad(\AppBundle\Entity\Actividad $actividad)
    {
        $this->actividades->removeElement($actividad);
    }
}
