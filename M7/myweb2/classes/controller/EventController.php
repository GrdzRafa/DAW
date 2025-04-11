<?php

class EventController extends Controller
{
    public function __construct() {}
    
    public function show($params=null) {
        $result= EventModel::getAll();
        $llistatEvents = $result->fetch_all(MYSQLI_NUM);
        $vEvent = new EventView();
        $vEvent->show($llistatEvents);
    }
    
    public function delete($params) {
        try {
            if (isset($params['delete-event-id'])) {
                $event_id = intval($params['delete-event-id']);
                if ($event_id > 0) {
                    if (EventModel::deleteEvent($event_id)) {
                        header("Location: ?Event/show");
                        exit();
                    } else {
                        throw new ErrorException("Error al eliminar l'event.");
                    }
                } else {
                    throw new ErrorException("ID de evento inválido.");
                }
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    
    public function addForm(){
        $vEventForm = new EventView();
        $vEventForm -> showAddForm();
    }
    
    public function add($params) {
        try {
            $nom = $params['nombre'];
            $fecha_ini = $params['fecha_ini'];
            $fecha_fi = $params['fecha_fi'];
            $etiquetes = $params['etiquetes'];
            $descripcio = $params['descripcion'];

            if (EventModel::addEvent($nombre, $fecha_inicio, $fecha_fin, $lugar, $descripcion)) {
                header("Location: ?Event/show");
                exit();
            } else {
                throw new Exception("Error al crear l'event.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    
}