<?php

class IdiomesView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        $idiomes = array("cat","euz","es","gb","fr","de");
        $idiomaActiu = $this->idiomaActiu;
        
        include $this->file;
        $menu_actiu="principal";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<section class=\"content\">";
        include "../inc/div_left_content.php";
        include "../inc/right-content_lang.php";
        echo "</section></main></body></html>";
    }
}

