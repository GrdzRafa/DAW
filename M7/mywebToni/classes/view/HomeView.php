<?php

class HomeView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        include $this->file;
        $menu_actiu="principal";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<section class=\"content\">";
        include "../inc/div_left_content.php";
		include "../inc/right-content.php";			
        echo "</section></main></body></html>";
    }
}

