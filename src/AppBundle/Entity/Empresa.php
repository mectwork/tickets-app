<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 */
class Empresa
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
     * @ORM\OneToMany(targetEntity="Proyecto", mappedBy="empresa", cascade="persist")
     */
    protected $proyectos;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="empresa", cascade="persist")
     */
    protected $usuarios;

    public function __construct()
    {
        $this->proyectos = new ArrayCollection();
        $this->usuarios = new ArrayCollection();

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
     * @return Empresa
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
     * Add proyecto
     *
     * @param \AppBundle\Entity\Proyecto $proyecto
     *
     * @return Empresa
     */
    public function addProyecto(\AppBundle\Entity\Proyecto $proyecto)
    {
        $this->proyectos[] = $proyecto;

        return $this;
    }

    /**
     * Remove proyecto
     *
     * @param \AppBundle\Entity\Proyecto $proyecto
     */
    public function removeProyecto(\AppBundle\Entity\Proyecto $proyecto)
    {
        $this->proyectos->removeElement($proyecto);
    }

    /**
     * Get proyectos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProyectos()
    {
        return $this->proyectos;
    }

    /**
     * Add usuario
     *
     * @param \UserBundle\Entity\User $usuario
     *
     * @return Empresa
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
}
