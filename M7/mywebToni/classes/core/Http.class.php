<?php

class Http {
    //Si la nostra classe treballa amb mètodes de classe, no haurà de
    //tenir atributs.
//     private $controller; 
//     private $action;
//     private $params;
    
    //Si la nostra classe treballa amb mètodes de classe, no pot tenir
    //constructor. En el seu lloc, crearé un mètode, també estatic, que
    //farà la mateixa funció.
//     public function __construct($controller_name, $action, $params) {
//         if (file_exists(__ROOT__."classes/controller/{$controller_name}Controller.php")) {
//             $classe = $controller_name."Controller";
//             $this->controller = new $classe();
//             if (method_exists($this->controller, $action)){
//                 $this->action = $action;
//                 $this->params = $params;
//             } else {
//                 throw new Exception("no existeix l'acció definida de $controller_name");
//             }
//         } else {
//             throw new Exception("no existeix la definició de $controller_name");
//         }
//     }


    public static function initialize($controller_name, $action, $params) {
        if (file_exists(__ROOT__."classes/controller/{$controller_name}Controller.php")) {
            $classe = $controller_name."Controller";
            $controller = new $classe();
            if (method_exists($controller, $action)){
//                 $this->action = $action;
//                 $this->params = $params;
                return true;
            } else {
                throw new Exception("no existeix l'acció definida de $controller_name");
            }
        } else {
            throw new Exception("no existeix la definició de $controller_name");
        }
    }
    
    //Com no tinc constructor, hauré de rebre els paràmetres en la funció
    public static function get($controller_name, $action, $params){
        $classe = $controller_name."Controller";
        if (self::initialize($controller_name, $action, $params)) {
            $controller = new $classe();
            $controller->$action($params);
        } else {
            throw new Exception("problemes al tractar el mètode GET");
        }
    }
    
    public static function post($controller_name, $action, $params){
        $classe = $controller_name."Controller";
        $acc = "form_$action";
        if (self::initialize($controller_name, $acc, $params)) {
            $controller = new $classe();
            $controller->$acc($params);
        } else {
            throw new Exception("problemes al tractar el mètode POST");
        }
    }
}

