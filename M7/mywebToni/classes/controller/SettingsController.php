<?php

class SettingsController {

    public function __construct() {}
    
    public function show() {
        $vVista = new SettingsView();
        $vVista->show();
    }
}

