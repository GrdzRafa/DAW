<?php 
namespace Frases\Entity;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 * @Table(name="tbl_Phrases")
 */
class ON_Phrase {
    /** @Id @GeneratedValue @Column(type="integer") */
    private $id;
    /** @Column(type="string", length=255, nullable=false, unique=true) */
    private $text;
    
    /** @ManyToMany(targetEntity="ON_Theme", mappedBy="frases")   */
    private $temes;
    /** @OneToOne(targetEntity="ON_Author") */
    private $autor;
    
    public function __construct() {
        $this->temes = new ArrayCollection();
    }
    public function getId() {       return $this->id;    }
    public function getText() {     return $this->text;  }
    public function getTema() {     return $this->tema;  }
    public function getAutor() {    return $this->autor; }
    
    public function setId($id) {        $this->id = $id;        }
    public function setText($text) {    $this->text = $text;    }
    
    public function setAutor(ON_Author $autor) {  
        $this->autor = $autor;
        $autor->addFrase($this);
    }
    public function addTema(ON_Theme $tema) {    
        $this->temes[] = $tema;
        $tema->addFrase($this);
    }
}


?>