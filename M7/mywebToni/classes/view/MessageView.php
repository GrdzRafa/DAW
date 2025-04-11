<?php

class MessageView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($titol, $missatge) {
        include $this->file;
        $menu_actiu="principal";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head_calendari.php";
        echo "<body><main>";
		include "../inc/main-menu.php";
        echo "<section class=\"contingut\">";
	    include "../inc/div_missatge.php";
		echo "</section></main></body></html>";
    }
}

