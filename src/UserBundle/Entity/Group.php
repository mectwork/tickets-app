<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grupo")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $name;

    protected $roles;

    public function __toString()
    {
        return strval($this->name);
    }

    public function __construct()
    {
        $this->roles = array();
    }

    public function getRoles()
    {
        return $this->roles;
    }
}