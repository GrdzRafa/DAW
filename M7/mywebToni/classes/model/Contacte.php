<?php

class Contacte {
    private $nom;
    private $email;
    private $telefon;
    private $assumpte;
    private $missatge;
    
    public $errors;
    
    public function __construct($nom, $email, $assumpte, $missatge) {
        $this->nom = $nom;
        $this->email = $email;
        $this->assumpte = $assumpte;
        $this->missatge = $missatge;
    }
    
    public function __get($atribut) {
        if(property_exists($this, $atribut)) {
            return $this->$atribut;
        }
    }
    
    public function __set($atribut, $value){
        if(property_exists($this, $atribut)) {
            $this->$atribut = $value;
        }
    }
    
}

