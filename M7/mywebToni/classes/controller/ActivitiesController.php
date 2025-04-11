<?php

class ActivitiesController {

    public function __construct() {}
    
    public function show() {
        $vVista = new ActivitiesView();
        $vVista->show();
    }
}

