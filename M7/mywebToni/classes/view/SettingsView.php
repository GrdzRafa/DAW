<?php

class SettingsView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        include $this->file;
        $menu_actiu = "configuracions";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<section class=\"content\">";
        echo "
        <div class=\"left-content\">
		  <img style=\"width:75%; margin: 0 auto;\" src=\"../images/en-construccio.jpg\"/>	
        </div>
        ";
        echo "</section></main></body></html>";
    }
}

