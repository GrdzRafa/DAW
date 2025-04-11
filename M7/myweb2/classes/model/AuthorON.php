<?php
class AuthorON {
    private $id;
    private $nom;
    private $descripcio;
    private $url;
    private $numFrases;
    
//     public function __construct($nom, $descripcio, $url) {
//         $this->nom = $nom;
//         $this->descripcio = $descripcio;
//         $this->url = $url;
//     }

    public function __construct() {}
    
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
?>
