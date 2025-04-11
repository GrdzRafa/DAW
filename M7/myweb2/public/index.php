<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
define("__ROOT__", __DIR__ . "/../");
include ("../assets/funcions.php");

// $idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
// include_once ("../langs/vars_{$idiomaActiu}.php");

// $menu_actiu="principal";

function my_autoload($classe) {
     $carpetes = array(".","core","controller", "model", "view");
    
    foreach($carpetes as $carpeta) {
        if (file_exists(__ROOT__ ."classes/$carpeta/$classe.php")) {
            include __ROOT__."classes/$carpeta/$classe.php";
            return;
        }
    }
}

function second_autoload($classe) {
    $carpetes = array(".","core","controller", "model", "view");
    
    foreach($carpetes as $carpeta) {
        if (file_exists(__ROOT__ ."classes/$carpeta/$classe.class.php")) {
            include __ROOT__."classes/$carpeta/$classe.class.php";
            return;
        }
    }
    throw new Exception("Definició de classe no trobada $classe");
    
}

try {

    //2. Esto iría comentado
     spl_autoload_register("my_autoload");
     spl_autoload_register("second_autoload");

     // 1. PARA QUE FUNCIONE EL AUTOLOAD DE DOCTRINE, TENGO QUE
     //HACER EL INCLUDE AQUÍ

     //EJ: require __ROOT__."vendor/autoload.php";
    
//     include "../classes/core/Potatoe.php";
//     $a = Potatoe::getInstance();
        
//     include "../classes/View.php";
//     include "../classes/HomeView.php";
    //3. Y esta primera línea también
     include __ROOT__."classes/model/UsuariModel.php";
     FrontController::recogerAlgodon();
    
   
    
} catch (Exception $e) {
//     include "../classes/ErrorView.php";
    ErrorView::show($e);
}
?>


