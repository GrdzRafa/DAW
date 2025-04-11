<?php

class DBModel {
    private static $instance = null;
    
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = 'Rafa2025@';
    protected $db_name = 'myweb';
    private $conn;
    
    private function open_connection() {
        $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
    }

    private function close_connection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }   
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBModel();        
        }
        return self::$instance;
    }
    
    public function execute(string $query, array $params = null, $types = "s") {
        try {
            $this->open_connection();
            $stmt = $this->conn->prepare($query);
            if (!$params) {
                $result = $stmt->execute();
            } else{
                $stmt->bind_param($types, ...($params));
                $stmt->execute();
            }
            $result = $stmt->get_result();
            return $result;
            $this->close_connection();
        } catch (Exception $e) {
            $this->close_connection();
            ErrorView::show($e);
        }
    }
}