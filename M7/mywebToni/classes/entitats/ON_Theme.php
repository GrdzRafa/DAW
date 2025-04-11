<?php 
namespace Frases\Entity;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 * @Table(name="tbl_Themes")
 */
class ON_Theme {
    /** @Id @GeneratedValue @Column(type="integer") */
    private $id;
    /** @Column(type="string", length=255, nullable=false, unique=true) */
    private $nom;
    
    /** @ManyToMany(targetEntity="ON_Phrase", inversedBy="temes")  
     * @JoinTable(name="rel_temes_frases", inverseJoinColumns={ @JoinColumn(name="tema_id", referencedColumnName="id")}) */
    private $frases; 
    
    public function __construct() {
        $this->frases = new ArrayCollection();
    }
    public function getId() {           return $this->id;   }
    public function getNom() {          return $this->nom;  }
    public function getFrases() {       return $this->frases; }
    
    public function setId($id) {        $this->id = $id;    }
    public function setNom($nom) {      $this->nom = $nom;  }
    
    public function addFrase(ON_Phrase $frase) {  
        $this->frases[] = $frase; 
    }
}


?>