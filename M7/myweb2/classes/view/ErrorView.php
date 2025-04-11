<?php

class ErrorView {
    
    public static function show($e) {
        $idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
        include ("../langs/vars_{$idiomaActiu}.php");
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head_calendari.php";
        echo "</head>";
        echo "<body><main>";
		include "../inc/main-menu.php";
        echo "<section class=\"contingut\">";
	    include "../inc/div_error.php";
		echo "</section></main></body></html>";
    }
}

