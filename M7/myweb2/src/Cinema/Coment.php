<?php
namespace Rgrdz\doctrine;
/**
 * Coment
 *
 * @Entity
 * @Table( name="comment" )
 *
 */
class Coment {
    /**
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @var string
     * @Column(type="string", length=100, name="texto")
     */
    private $texto;
    /**
     * @var date
     * @Column(type="date", name="date", nullable=false,
     * unique=false )
     */
    private $fecha;
    /**
     * Get id
     * @return integer
     */
    
    /**
     * @var Film
     * @ManyToOne(targetEntity="Film",
     * inversedBy="comentaris")
     */
    private $pelicula ;
    
//     public function getId() {
//         return $this->id;
//     }
//     /**
//      * Set texto
//      * @param string $texto
//      * @return Coment
//      */
//     public function setTexto($texto) {
//         $this->texto = $texto;
//         return $this;
//     }
//     /**
//      * Get texto
//      * @return string
//      */
//     public function getTexto() {
//         return $this->texto;
//     }
//     /**
//      * Set fecha
//      * @param \DateTime $fecha
//      * @return Coment
//      */
//     public function setFecha($fecha) {
//         $this->fecha = $fecha;
//         return $this;
//     }
//     /**
//      * Get fecha
//      * @return \DateTime
//      */
//     public function getFecha() {
//         return $this->fecha;
//     }
}