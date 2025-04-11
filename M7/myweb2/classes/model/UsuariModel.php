<?php
require_once('DBAbstractModel.php');

class Usuari extends DBAbstractModel {

    public $nom;
    public $cognom;
    public $email;
    private $password;
    protected $id;

    function __construct() {
        $this->db_name = 'book_example';
    }

    public function get($user_email = '') {
        if ($user_email != '') {
            $this->query = "
                 SELECT id, nombre, apellido, email, clave
                 FROM usuarios
                 WHERE email = '$user_email'
                 ";
            $this->get_results_from_query();
        }

        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
            }
        }
    }

    public function set($user_data = array()) {
        if (array_key_exists('email', $user_data)) {
            $this->get($user_data['email']);
            if ($user_data['email'] != $this->email) {
                foreach ($user_data as $camp => $valor) {
                    $$camp = $valor;
                }
                $this->query = "
                     INSERT INTO usuaris
                     (nom, cornom, email, clau)
                     VALUES
                     ('$nom', '$cognom', '$email', '$clau')
                     ";
                $this->execute_single_query();
            }
        }
    }

    public function edit($user_data = array()) {
        foreach ($user_data as $campo=>$valor) {
            $$campo = $valor;
            $this->query = "
                 UPDATE usuaris
                 SET nom='$nom',
                 cognom='$cornom',
                 clau='$clau'
                 WHERE email = '$email'
                 ";
            $this->execute_single_query();
        }
    }

    public function delete($user_email = '') {
        $this->query = "
             DELETE FROM usuaris
             WHERE email = '$user_email'
             ";
        $this->execute_single_query();
    }

//     public function __destruct() {
//         unset($this);
//     }
}