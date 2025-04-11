<?php

use PSpell\Config;

abstract class DBAbstractModel {

    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_port;
    private $db_socket;

    protected $db_name;
    protected $query;
    protected $rows = array();

    private $conn;

    # mètodes abstractes per a ABM de classes que heretin
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete();

    private function get_config() {
        $configuracio = Configuracio::getInstance();
 
        $this->db_host = $configuracio->getHost();
        $this->db_user = $configuracio->getUsername();
        $this->db_pass = $configuracio->getPassword();
        $this->db_name = $configuracio->getDb_name();
        $this->db_port = $configuracio->getPort();
        $this->db_socket = $configuracio->getSocket();
    }
    
    # els següents mètodes poden definir-se amb exactitud
    # i no són abstractes
    # Connectar a la base de dades
    private function open_connection() {
        $this->get_config();
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }

    # Desconectar la base de dades
    private function close_connection() {
        $this->conn->close();
    }

    # Executar un query simple del tipus INSERT, DELETE, UPDATE
    protected function execute_single_query() {
        $this->open_connection();
        $this->conn->query($this->query);
        $this->close_connection();
    }

    # Portar resultats d'una consulta en un Array
    protected function get_results_from_query() {
        $this->rows = array();
        $this->open_connection();
        $result = $this->conn->query($this->query);
        while ($this->rows[] = $result->fetch_assoc());
        $result->close();
        $this->close_connection();
        array_pop($this->rows);
    }
}


