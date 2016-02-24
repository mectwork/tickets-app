<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_completo", type="string", length=255)
     */
    private $nombrecompleto;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Empresa", inversedBy="usuarios")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $empresa;

    /**
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Proyecto", inversedBy="usuarios")
     * @ORM\JoinTable(name="proyecto_usuario")
     */
    private $proyectos;

    /**
     * @ORM\ManyToMany(targetEntity="\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="grupo_usuario",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    public function __construct() {
        parent::__construct();
        $this->groups = new ArrayCollection();

        $this->proyectos = new ArrayCollection();
    }

    /**
     * Set nombrecompleto
     *
     * @param string $nombrecompleto
     *
     * @return Empresa
     */
    public function setNombrecompleto($nombrecompleto)
    {
        $this->nombrecompleto = $nombrecompleto;

        return $this;
    }

    /**
     * Get nombrecompleto
     *
     * @return string
     */
    public function getNombrecompleto()
    {
        return $this->nombrecompleto;
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
     * Add grupo
     *
     * @param \AppBundle\Entity\Group $grupo
     *
     * @return Group
     */
    public function addGrupo(\AppBundle\Entity\Group $grupo)
    {
        $this->groups[] = $grupo;

        return $this;
    }

    /**
     * Remove grupo
     *
     * @param \AppBundle\Entity\Group $grupo
     */
    public function removeGrupo(\AppBundle\Entity\Group $grupo)
    {
        $this->groups->removeElement($grupo);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->groups;
    }
}
