<?php

class ProfileController {

    public function __construct() {}
    
    public function show($params=null) {
        $vProfile = new ProfileView();
        $vProfile->show();
    }
}

