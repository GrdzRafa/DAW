<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

session_start();
define("__ROOT__", __DIR__ . "/../");

try {
    include __ROOT__ . "classes/core/Autoload.class.php";
    spl_autoload_register("Autoload::my_autoload");
    spl_autoload_register("Autoload::second_autoload");

    FrontController::dispatch();
} catch (Exception $e) {
    ErrorView::show($e);
}
?>


