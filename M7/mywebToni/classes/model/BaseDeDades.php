<?php

class BaseDeDades {
    private $sgbd;
    private $server;
    private $user;
    private $password;
    private $base;
    
    private $link;
    
    private static $_instance;

    private function __construct(){
        $config = Configuracio::getInstance();
        $this->server = $config->getHost();
        $this->user = $config->getUsername();
        $this->password = $config->getPassword();
        $this->base = "my_web";
        $this->sgbd = "mysql";
        
        switch ($this->sgbd) {
            case "mysql":
                if ($link = new mysqli($this->server, $this->user, $this->password, $this->base)) {
                    $this->link = $link;
                } else {
                    throw new Exception ("no m'he conectat");
                }
                break;
            case "pgsql":
                
                break;
            case "oracle":
                
                break;
            case "mongodb":
                
                break;
        }
                
    }
    
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __destruct() {
        switch ($this->sgbd) {
            case "mysql":
                $this->link->close();
                break;
            case "pgsql":
                
                break;
            case "oracle":
                
                break;
            case "mongodb":
                
                break;
        }        
    }
    
    public function executarSQL($sSql, $aParam=null) {
        switch ($this->sgbd) {
            case "mysql":
                if ($stmt = $this->link->prepare($sSql)) {
                    if ($stmt->execute($aParam)) {
                        $dades = true;
                        if ($res = $stmt->get_result()) {
                            $dades = $res->fetch_all(MYSQLI_ASSOC);
                        }
                    }
                }
                break;
            case "pgsql":
                
                break;
            case "oracle":
                
                break;
            case "mongodb":
                
                break;
        }
        
        return $dades;
    }
    
    public function changeUser($us, $ct) {
        switch ($this->sgbd) {
            case "mysql":
                $this->link->change_user($us, $ct, $this->base);
                break;
            case "pgsql":
                
                break;
            case "oracle":
                
                break;
            case "mongodb":
                
                break;
        }
        
    }
    
    public function getLink() {
        return $this->link;
    }
    private function __clone(){}
}

