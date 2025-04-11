<?php

class UserView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show(Usuari $usuari=NULL) {
        include $this->file;
        $menu_actiu="principal";
        
        if ($usuari != NULL) {
            $mail = $usuari->email;
            $error["email"] = $usuari->errorsDetectats["email"];
            $pass = $usuari->getPassword();
            $error['pass'] = $usuari->errorsDetectats["password"];
            $error['conn'] = $usuari->errorsDetectats["conn"];
        }
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        
        echo "<section class=\"content\">";
        include "../inc/div_left_content.php";
		include "../inc/right-content_log.php";	
        echo "</section></main></body></html>";
    }
    
    public function form_show(ContacteModel $contacte) {
        include $this->file;
        $menu_actiu="principal";
        
        $errorNom  = ($contacte instanceof ContacteModel && isset($contacte->errors["nom"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["nom"]}\""
        : " value=\"{$contacte->__get("nom")}\"";
        $errorMail = ($contacte instanceof ContacteModel && isset($contacte->errors["email"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["email"]}\""
        : " value=\"{$contacte->__get("email")}\"";
        $errorTelf = ($contacte instanceof ContacteModel && isset($contacte->errors["telefon"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["telefon"]}\""
        : " value=\"{$contacte->__get("telefon")}\"";
        $errorAssu = ($contacte instanceof ContacteModel && isset($contacte->errors["assumpte"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["assumpte"]}\""
        : " value=\"{$contacte->__get("assumpte")}\"";
        $errorMiss = ($contacte instanceof ContacteModel && isset($contacte->errors["missatge"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["missatge"]}\""
        : "";
        $frm_missatge = ($contacte instanceof ContacteModel) ? $contacte->__get("missatge") : "";
        
        if (is_null($contacte->__get("errors"))) {
            $info = "<div class=\"activity-three\"><label>Dades enviades correctament.</label></div><br />";
        } else {
            $info ="<label>(*)Camp obligatori.</label><br />";
        }
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        
        echo "<section class=\"content\">";
        echo "<div class=\"left-content\"><form action=\"\" method=\"post\">
        <h1>Formulari de contacte</h1><br/>
        <label for=\"name\">El teu nom (*): </label>
            <input type=\"text\" id=\"nom\" name=\"nom\" minlength=\"4\" maxlength=\"40\" size=\"10\" $errorNom/><br />
		<label for=\"email\">Correu electrónic (*): </label>
            <input type=\"text\" id=\"email\" name=\"email\" minlength=\"10\" maxlength=\"60\" size=\"10\" $errorMail/><br />
		<label for=\"telefon\">Telèfon: </label>
            <input type=\"text\" id=\"telefon\" name=\"telefon\" minlength=\"9\" maxlength=\"14\" $errorTelf/> <br />
		<label for=\"assumpte\">Assumpte (*): </label>
            <input type=\"text\" id=\"assumpte\" name=\"assumpte\" minlength=\"5\" maxlength=\"60\" $errorAssu/> <br />
		<label for=\"missatge\">Missatge (*): </label><br />
				<textarea id=\"missatge\" name=\"missatge\" rows=\"8\" cols=\"80\" $errorMiss>$frm_missatge</textarea><br />
        $info
            
		<button class=\"btn\" name=\"boto\" value=\"Envia\">Envia les dades</button>
		</form></div>";
        echo "</section></main></body></html>";
    }
    
    public function registre(Usuari $usuari = new Usuari()) {
        include $this->file;
        $menu_actiu="principal";
        
        $errorsDetectats = $usuari->errorsDetectats;
        $options = ["type"=>"text",
            "name"=>"email",
            "placeholder"=>"email (Obligatori)",
            "class"=>"llarg",
            "value"=> $usuari->email,
            "span"=> $usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["email"] ];
        $input_email = $this->html_generaInput($options);
        
        $options = [
            "type"=>"password",
            "name"=>"pass",
            "placeholder"=>"Contrasenya (Obligatori)",
            "class"=>"llarg",
            "value"=>$usuari->getPassword(),
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["pass"] ];
        $input_pass = $this->html_generaInput($options);
        
        $options = [
            "type"=>"password",
            "name"=>"cpass",
            "placeholder"=>"Confirma la contrasenya (Obligatori)",
            "class"=>"llarg",
            "value"=>$usuari->getPassword(),
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["cpass"] ];
        $input_cpass = $this->html_generaInput($options);
        
        $options = [
            "type"=>"button",
            "name"=>"next",
            "class"=>"next action-button",
            "value"=>"Next" ];
        $input_bNext = $this->html_generaInput($options);
        
        $atributs = [
            "class"=>"curt",
            "name"=>"tipus",
            "span"=>$usuari->errorsDetectats=== null ? "" : $usuari->errorsDetectats["tipus"] ];
        $opcions = [
            "NIF"=>"NIF: Número d'Identificació Fiscal",
            "NIE"=>"NIE: Número d'Identificació d'Extranjers",
            "PAS"=>"PAS: Passaport" ];
        $seleccionat = ($usuari->tipusIdent!==null) ? $usuari->tipusIdent : "NIF";
        $select_Tipus = $this->html_generateSelect($opcions, $seleccionat, $atributs);
        
        $options = [
            "type"=>"text",
            "name"=>"dni",
            "placeholder"=>"DNI (Obligatori)",
            "class"=>"curt",
            "value"=> $usuari->numeroIdent,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["dni"] ];
        $input_dni = $this->html_generaInput($options);
        
        $options = [
            "type"=>"text",
            "name"=>"nom",
            "placeholder"=>"Nom (Obligatori)",
            "class"=>"llarg",
            "value"=>$usuari->nom,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["nom"] ];
        $input_nom = $this->html_generaInput($options);
        
        $options = [
            "type"=>"text",
            "name"=>"cognoms",
            "placeholder"=>"Cognoms (Obligatori)",
            "class"=>"llarg",
            "value"=>$usuari->cognoms,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["cognoms"]  ];
        $input_cognoms = $this->html_generaInput($options);
        
        $opcions = [
            "sexe1" => [
                "name" => "sexe",
                //"class" => "curt",
                "value" => "H",
                "checked"=>($usuari->sexe=="H") ? true : false,
                "label"=>"Home" ] ,
            "sexe2" => [
                "name" => "sexe",
                //"class" => "curt",
                "value" => "D",
                "checked"=>($usuari->sexe=="D") ? true : false,
                "label"=>"Dona" ]
        ];
        $select_Sexe = $this->html_generateRadioButon($opcions);
        
        
        $options = [
            "type"=>"text",
            "name"=>"naixement",
            "placeholder"=>"Data de naixement (Obligatori)",
            "class"=>"llarg",
            "value"=>$usuari->datanaixement,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["dNaixement"] ];
        $input_naixement = $this->html_generaInput($options);
        
        $options = [
            "type"=>"button",
            "name"=>"previous",
            "class"=>"previous action-button",
            "value"=>"Previous" ];
        $input_bPrev = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "name"=>"adreca",
            "placeholder"=>"Adreça",
            "value"=>$usuari->adreca,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["adreca"] ];
        $input_adreca = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"cp",
            "placeholder"=>"C.P.",
            "value"=>$usuari->codiPostal,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["cp"]  ];
        $input_cp = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"poblacio",
            "placeholder"=>"Població",
            "value"=>$usuari->poblacio,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["poblacio"] ];
        $input_poblacio = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"provincia",
            "placeholder"=>"Provincia",
            "value"=>$usuari->provincia,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["provincia"] ];
        $input_provincia = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"telefon",
            "placeholder"=>"Teléfon",
            "value"=>$usuari->telefon,
            "span"=>$usuari->errorsDetectats===null ? "" : $usuari->errorsDetectats["telefon"] ];
        $input_telefon = $this->html_generaInput($options);
        
        $options = [
            "type"=>"hidden",
            "name"=>"MAX_FILE_SIZ",
            "value"=>"2097152" ];
        $input_maxFileSize = $this->html_generaInput($options);
        
        $options = [
            "type"=>"file",
            "class"=>"llarg",
            "name"=>"imatge",
            "id"=>"imatge",
            "value"=>$usuari->imatge,
            "span"=>$usuari->errorsDetectats==null ? "" : $usuari->errorsDetectats["imatge"] ];
        $input_imatge = $this->html_generaInput($options);
        
        $options = [
            "type"=>"submit",
            "name"=>"submit",
            "class"=> "submit action-button",
            "value"=> "Envia Dades"];
        $input_bSend = $this->html_generaInput($options);
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        
        echo "<div class=\"left-content\">";
        include "../inc/div_left_registre.php";
		echo "</div></main></body></html>";
    }
    
    public function form_registre(Usuari $usuari) {
        $this->registre($usuari);
    }
}




