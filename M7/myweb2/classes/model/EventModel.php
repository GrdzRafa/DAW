<?php
class EventModel
{
    public static function getAll(){
        $db = DBModel::getInstance();
        $query = "SELECT * FROM tbl_events;";
        
        try {
            $result = $db->execute($query);
            return $result;
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    
    public static function getBetweenDates(DateTime $startDate, DateTime $endDate) {
        $db = DBModel::getInstance();
        $query = "SELECT * FROM tbl_events WHERE fecha_ini >= ? AND fecha_fin < ?;";
        
        // adjustar dates per incluir hores
        $params = [
            $startDate->format('Y-m-d 00:00:00'),
            $endDate->format('Y-m-d 23:59:59')
        ];
        
        try {
            $result = $db->execute($query, $params, "ss");
            return $result;
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    
    public static function deleteEvent($event_id) {
        $db = DBModel::getInstance();
        $query = "DELETE FROM tbl_events WHERE id = ?";
        try {
            $stmt = $db->execute($query, [$event_id], "i");
            return true;
        } catch (Exception $e) {
            ErrorView::show($e);
            return false;
        }
    }
    
    public static function addEvent($nombre, $fecha_inicio, $fecha_fin, $lugar, $descripcion) {
        $db = DBModel::getInstance();
        $query = "INSERT INTO tbl_events (titol, descripcio, fecha_ini, fecha_fin, etiquetes) VALUES (?, ?, ?, ?, ?)";
        
        $params = [
            $id,
            $nombre,
            $fecha_inicio,
            $fecha_fin,
            $lugar,
            $descripcion
        ];
        
        try {
            $result = $db->execute($query, $params, "sssss");
            return $result;
        } catch (Exception $e) {
            ErrorView::show($e);
            return false;
        }
    }
    
    //métodos que habrán en el modelo que usaremos para el calendario
    //READ / GET / SELECT / UPDATE (CRUD) create - read - update - delete
    
    //TAMBIÉN ESTOS
    //getAll
    //getOneById
    //getBetweenDates
    //un método que convierta el resultSet (los resultados que devuelve base de datos)
    //en Eventos (objetos eventModel).
}

