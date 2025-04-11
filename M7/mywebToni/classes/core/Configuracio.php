<?php

class Configuracio {
    private static $_instance;
    
    private $host;
    private $username;
    private $password;
    private $db_name;
    private $port;
    private $socket;
    
    private function __construct() {
        $filename="../config/config.xml";
        if (file_exists($filename)) {
            if ($fitxer = simplexml_load_file($filename)) {
                $this->host = $fitxer->base_de_dades->host->__toString();
                $this->db_name = $fitxer->base_de_dades->db_name->__toString();
                $this->password = $fitxer->base_de_dades->password->__toString();
                $this->username = $fitxer->base_de_dades->username->__toString();
                $this->port = $fitxer->base_de_dades->port->__toString();
                $this->socket = $fitxer->base_de_dades->socket->__toString();
            } else {
                throw new Exception("Fitxer de configuració amb mal format");
            }
        } else {
            throw new Exception("No s'ha pogut obrir el fitxer de configuració");
        }
    }
    
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        } 
        return self::$_instance;        
    }
    
    private function __clone() {}
    
    public function getHost() {
        return $this->host;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getDb_name() {
        return $this->db_name;
    }
    
    public function getPort() {
        return $this->port;
    }
    
    public function getSocket() {
        return $this->socket;
    }
    
}

