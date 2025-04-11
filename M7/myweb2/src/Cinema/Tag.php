<?php
namespace Rgrdz\doctrine;
/**
 * Tag
 *
 * @Entity
 * @Table( name="tag" )
 *
 */
class Tag {
    /**
     * @var string
     * @Id
     * @Column(type="string", name="name", nullable=false, unique=true)
     */
    private $texto;
    /**
     * Set texto
     * @param string $texto
     * @return Tag
     */
    public function setTexto($texto) {
        $this->texto = $texto;
        return $this;
    }
    /**
     * Get texto
     * @return string
     */
    public function getTexto() {
        return $this->texto;
    }
}