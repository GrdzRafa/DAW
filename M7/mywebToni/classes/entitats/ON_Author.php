<?php 
namespace Frases\Entity;

/** 
 * @Entity 
 * @Table(name="tbl_Authors") 
 */
class ON_Author {
    /** @Id @GeneratedValue @Column(type="integer") */
    private $id;
    /** @Column(type="string", length=255, nullable=true) */
    private $url;
    /** @Column(type="string", length=255, unique=true) */
    private $nom;
    /** @Column(type="string", length=255) */
    private $descripcio;
    
    /** @OneToMany(targetEntity="ON_Phrase", mappedBy="autor") */
    private $frases;
    
    public function getId() {               return $this->id;       }
    public function getUrl() {              return $this->url;      }
    public function getNom() {              return $this->nom;      }
    public function getDescripcio() {       return $this->descripcio;    }
    public function getFrases() {           return $this->frases;}

    public function setId($id) {            $this->id = $id;      }
    public function setUrl($url) {          $this->url = $url;    }
    public function setNom($nom) {          $this->nom = $nom;    }
    public function setDescripcio($descripcio) {  $this->descripcio = $descripcio;   }    
    
    public function addFrase(ON_Phrase $frase) { 
        $this->frases[] = $frase; 
    }    
}
?>