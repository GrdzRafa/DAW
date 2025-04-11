<?php
namespace Frases\Entity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 * @Table(name="tbl_Authors")
 */
class Author
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

    /**
     * @var string
     * @Column(type="string", length=100, name="description", nullable=false)
     */
    private $description;


    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    // Métodos getter y setter
}