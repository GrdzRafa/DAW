<?php

class MaintenanceController {

    public function __construct() {}
    
    public function show() {
        $vVista = new MaintenanceView();
        $vVista->show();
    }
}

