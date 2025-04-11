<?php

class IdiomesController extends Controller{

    public function __construct() {}
    
    public function show() {
        $vVista = new IdiomesView();
        $vVista->show();
    }
    
    public function set($params) {
        $idiomes = array("cat","euz","es","gb","fr","de");
        
        $_lang = $this->sanitize($params[0]);
        if (in_array($_lang, $idiomes)) {
            $res=setcookie("lang",$_lang, time()+86400 * 30); //86400 és 1 dia
            $_COOKIE["lang"] = $_lang;
        }
        
        $this->show();
    }
}

