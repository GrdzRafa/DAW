<?php
namespace Rgrdz\doctrine;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pelicula
 *
 * @Entity
 * @Table( name="movie", indexes={ @Index(name="year_idx", columns="year") }
 * )
 *
 */
class Film
{
    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @var string
     *
     * @Column(type="string", length=100, name="spanish_title")
     */
    private $titulo;
    /**
     * @var string
     *
     * @Column(type="string", length=100, name="original_title",
     * nullable=false)
     */
    private $tituloOriginal;
    /**
     * @var string
     *
     * @Column(type="string", length=100)
     */
    private $director;
    /**
     * @var int
     *
     * @Column(type="integer", name="year", nullable=false, unique=false,
     * options={"unsigned":true, "default":0})
     */
    private $anyo;

    //mappedBy es el nombre del atributo en la otra clase donde hagamos la relación
    //cuando usas mappedBy, tienes que definir la clase Owner, que en este caso
    //es "pelicula"
    /**
     * @var Coment[]
     * @OneToMany(targetEntity="Coment", mappedBy="pelicula")
     */
    private $comentaris;

    /**
     * Inicialitzem coleccions
     */
    public function __construct()
    {
        $this->comentaris = new ArrayCollection();
        $this-> etiquetes = new ArrayCollection ();
    }
    /**
     * Add Coment
     * @param Coment $comentari
     * @return Film
     */
    public function addComentari(Coment $comentari)
    {
        $this->comentaris[] = $comentari;
        $comentari->setPelicula($this);
        return $this;
    }

    /**
     * @var Tag[]
     * @ManyToMany(targetEntity="Tag", inversedBy="pelicules",
     * fetch="EAGER", cascade={"persist"}, orphanRemoval=true
     * )
     * @JoinTable(
     * name="movie_tag",
     * inverseJoinColumns={
     * @JoinColumn(name="tag_name",
     * referencedColumnName="name") }
     * )
     */
    private $etiquetes;
    //     /**
//      * Get id
//      * @return integer
//      */
//     public function getId() {
//         return $this-> id;
//     }
//     /**
//      * Set titulo
//      * @param string $titulo
//      * @return Film
//      */
//     public function setTitulo($titulo){
//         $this-> titulo = $titulo;
//         return $this;
//     }
//     /**
//      * Get titulo
//      * @return string
//      */
//     public function getTitulo() {
//         return $this-> titulo ;
//     }
//     /**
//      * Set tituloOriginal
//      * @param string $tituloOriginal
//      * @return Film
//      */
//     public function setTituloOriginal($tituloOriginal) {
//         $this-> tituloOriginal = $tituloOriginal;
//         return $this;
//     }
//     /**
//      * Get tituloOriginal
//      * @return string
//      */
//     public function getTituloOriginal() {
//         return $this-> tituloOriginal ;
//     }
//     /**
//      * Set director
//      * @param string $director
//      * @return Film
//      */
//     public function setDirector($director) {
//         $this-> director = $director;
//         return $this;
//     }
//     /**
//      * Get director
//      * @return string
//      */
//     public function getDirector() {
//         return $this-> director;
//     }
}
