<?php
namespace Frases\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="tbl_Themes")
 */
class Theme
{
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Column(type="string", length=100, name="name", nullable=false, unique=true)
     */
    private $name;

    public function __construct()
    {
        $this->phrases = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }   

}
