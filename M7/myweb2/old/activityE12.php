<?php
session_start();
include ("../assets/funcions.php");

$idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
include_once ("../langs/vars_{$idiomaActiu}.php");

$newTable = webScrappingInversis();

echo "<pre>";
var_dump($newTable);
echo "</pre>";