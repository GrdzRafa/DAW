<?php

class ContactaView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        include $this->file;
        $menu_actiu="principal";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "</head>";
        echo "<body><main>";
        include "../inc/main-menu.php";
        
        echo "<section class=\"content\">";
        echo "<div class=\"left-content\"><form action=\"\" method=\"post\">
        <h1>Formulari de contacte</h1><br/>
        <label for=\"name\">El teu nom (*): </label> 
            <input type=\"text\" id=\"nom\" name=\"nom\" minlength=\"4\" maxlength=\"40\" size=\"10\" /><br />
		<label for=\"email\">Correu electrónic (*): </label> 
            <input type=\"text\" id=\"email\" name=\"email\" minlength=\"10\" maxlength=\"60\" size=\"10\" /><br />
		<label for=\"telefon\">Telèfon: </label> 
            <input type=\"text\" id=\"telefon\" name=\"telefon\" minlength=\"9\" maxlength=\"14\" /> <br />
		<label for=\"assumpte\">Assumpte (*): </label> 
            <input type=\"text\" id=\"assumpte\" name=\"assumpte\" minlength=\"5\" maxlength=\"60\" /> <br />
		<label for=\"missatge\">Missatge (*): </label><br />
				<textarea id=\"missatge\" name=\"missatge\" rows=\"8\" cols=\"80\"></textarea><br /> 
        <label>(*)Camp obligatori.</label><br />
				
		<button class=\"btn\" name=\"boto\" value=\"Envia\">Envia les dades</button>
		</form></div>";
        echo "</section></main></body></html>";
    }
    
    public function form(PerroSanchez $contacte) {
        include $this->file;
        $menu_actiu="principal";
        
        $errorNom  = ($contacte instanceof PerroSanchez && isset($contacte->errors["nom"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["nom"]}\""
        : " value=\"{$contacte->__get("nom")}\"";
        $errorMail = ($contacte instanceof PerroSanchez && isset($contacte->errors["email"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["email"]}\""
        : " value=\"{$contacte->__get("email")}\"";
        $errorTelf = ($contacte instanceof PerroSanchez && isset($contacte->errors["telefon"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["telefon"]}\""
        : " value=\"{$contacte->__get("telefon")}\"";
        $errorAssu = ($contacte instanceof PerroSanchez && isset($contacte->errors["assumpte"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["assumpte"]}\""
        : " value=\"{$contacte->__get("assumpte")}\"";
        $errorMiss = ($contacte instanceof PerroSanchez && isset($contacte->errors["missatge"]))
        ? "class=\"error\" placeholder=\"{$contacte->__get("errors")["missatge"]}\""
        : "";
        $frm_missatge = ($contacte instanceof PerroSanchez) ? $contacte->__get("missatge") : "";
        
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
}




