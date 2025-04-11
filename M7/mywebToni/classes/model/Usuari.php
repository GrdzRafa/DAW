<?php
require_once('DBAbstractModel.php');

class Usuari extends DBAbstractModel {

    protected $id;
    public $email;
    private $password;
    public $tipusIdent;
    public $numeroIdent;
    public $nom;
    public $cognoms;
    public $sexe;
    public $datanaixement;
    public $adreca;
    public $codiPostal;
    public $poblacio;
    public $provincia;
    public $telefon;
    public $imatge;
    public $status;
    public $navegador;
    public $plataforma;
    public $dataCreacio;
    public $dataDarrerAcces;

    public $errorsDetectats;

    function __construct() {
        $this->db_name = 'my_web';
    }

    public function get($user_email = '') {
        if ($user_email == '') {
            $user_email = $this->email;
        }
        $this->query = "
             SELECT id, nom, cognoms, password, status, imatge
             FROM tbl_usuaris
             WHERE email = '$user_email'
             ";
        $this->get_results_from_query();
        
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function getOneById($id) {
        $this->query = "
             SELECT id, email
             FROM tbl_usuaris
             WHERE id = '$id'
             ";
        $this->get_results_from_query();
        
        if (count($this->rows) == 1) {
            $this->get($this->rows[0]['email']);
            return true;
        } else {
            return false;
        }
    }

    public function set($user_data = array()) {
        //Si rebo un paràmetre amb clau 'email' obtinc el registre de la 
        //bbdd amb aquest email
        if (array_key_exists('email', $user_data)) {
            $this->get($user_data['email']);
            if ($user_data['email'] != $this->email) {
                //Carrego els camps existents a la BBDD
                foreach ($user_data as $camp => $valor) {
                    $$camp = $valor;
                }
            }
        }
                
        $adreca = (isset($this->adreca)) ? "'{$this->adreca}'" : "NULL";
        $codiPostal = (isset($this->codiPostal)) ? "'{$this->codiPostal}'" : "NULL";
        $poblacio = (isset($this->poblacio)) ? "'{$this->poblacio}'" : "NULL";
        $provincia = (isset($this->provincia)) ? "'{$this->provincia}'" : "NULL";
        $telefon = (isset($this->telefon)) ? "'{$this->telefon}'" : "NULL";
        
        $iniciCadena    = strpos($_SERVER["HTTP_USER_AGENT"], "(") + 1;
        $finalCadena    = strpos($_SERVER["HTTP_USER_AGENT"], ")") - 1;
        $navegador      = substr($_SERVER["HTTP_USER_AGENT"], 0, strpos($_SERVER["HTTP_USER_AGENT"], "("));
        $plataforma     = substr($_SERVER["HTTP_USER_AGENT"], $iniciCadena, $finalCadena - $iniciCadena);
        
        $sSql = "INSERT INTO tbl_usuaris
        (id, email, password, tipusIdent,
        numeroIdent, nom, cognoms, sexe,
        naixement, adreca, codiPostal, poblacio, provincia,
        telefon, imatge, status,
        navegador, plataforma)
        VALUES
        (NULL,'{$this->email}','{$this->getPassword()}','{$this->tipusIdent}',
        '{$this->numeroIdent}','{$this->nom}','{$this->cognoms}','{$this->sexe}',
        '{$this->datanaixement}', $adreca, $codiPostal, $poblacio, $provincia,
        $telefon, '{$this->imatge}', 0,
        '$navegador', '$plataforma');";
        
        $this->query = $sSql;
        $this->execute_single_query();
    }

    public function edit($user_data = array()) {
        foreach ($user_data as $campo=>$valor) {
            $$campo = $valor;
        }
        $this->query = "
                 UPDATE tbl_usuaris
                 SET status=$status
                 WHERE id = '$id'
                 ";
        $this->execute_single_query();
    }

    public function delete($user_email = '') {
        $this->query = "
             DELETE FROM usuaris
             WHERE email = '$user_email'
             ";
        $this->execute_single_query();
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($pass) {
        $this->password = $pass;
    }
    
    public function setId($id) {
        $this->id=$id;
    }
    
    public function getId() {
        return $this->id;
    }

}