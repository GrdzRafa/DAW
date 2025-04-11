<?php

class ContactaController extends Controller{

    public function __construct() {}
    
    public function show() {
        $vContacta = new ContactaView();
        $vContacta->show();
    }
    
    public function form_show($params) {
        $frm_nom="";
        $frm_email="";
        $frm_assumpte="";
        $frm_missatge="";
        $frm_telefon="";
        
        if (strlen($params["nom"]) == 0) {
            $errors["nom"] = "El camp nom és obligatori";
        } else {
            $frm_nom = ($this->validateItem($params["nom"], "nom")) ? $this->sanitize($params["nom"]) : "";
            if ($frm_nom == "")
                $errors["nom"] = "El camp NOM no ha passat les validacions";
        }
        if (strlen($params["email"]) == 0) {
            $errors["email"] = "El camp email és obligatori";
        } else {
            $frm_email = ($this->validateItem($params["email"], "email")) ? $this->sanitize(strtolower($params["email"]), "email") : "";
            if ($frm_email == "")
                $errors["email"] = "El camp EMAIL no ha passat les validacions";
        }
        if (isset($params["telefon"])) {
            $frm_telefon = ($this->validateItem($params["telefon"], "phone")) ? $this->sanitize($params["telefon"], "int") : "";
            if ($frm_telefon == "")
                $errors["telefon"] = "El camp TELEFON no ha passat les validacions";
        }
        if (strlen($params["assumpte"]) == 0) {
            $errors["assumpte"] = "El camp assumpte és obligatori";
        } else {
            $frm_assumpte = ($this->validateItem($params["assumpte"], "alfanum")) ? $this->sanitize($params["assumpte"]) : "";
            if ($frm_assumpte == "")
                $errors["assumpte"] = "El camp ASSUMPTE no ha passat les validacions";
        }
        if (strlen($params["missatge"]) == 0) {
            $errors["missatge"] = "El camp missatge és obligatori";
        } else {
            $frm_missatge = ($this->validateItem($params["missatge"], "alfanum")) ? $this->sanitize($params["missatge"]) : "";
            if ($frm_missatge == "")
                $errors["missatge"] = "El camp MISSATGE no ha passat les validacions";
        }
        
        $nouContacte = new ContacteModel($frm_nom, $frm_email, $frm_assumpte, $frm_missatge);
        if (isset($frm_telefon)) {
            $nouContacte->__set("telefon",$frm_telefon);
        }
        if (isset($errors)) {
            $nouContacte->__set("errors",$errors);
        } else {
            $mContacte = new ContacteModel();
            $mContacte->set($nouContacte);
            $nouContacte=new ContacteModel("", "", "", "");
        }
        
        $vContacta = new ContactaView();
        $vContacta->form($nouContacte);
    }
}

