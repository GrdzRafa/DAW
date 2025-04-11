<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include ("../assets/funcions.php");

$idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
include_once ("../langs/vars_{$idiomaActiu}.php");

function validarNif ($nif) {
    $nif = strtoupper($nif);
    $lletresValides = "TRWAGMYFPDXBNJZSQVHLCKE";
    $nifCorrecte = FALSE;
    
    if ((strlen($nif)== 9) && (strpos("XYZ0123456789",$nif[0])!==false)) {
        $numero = substr($nif, 0, 8);
        $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);
        
        if(substr($nif, -1, 1) == substr($lletresValides, $numero % 23, 1)) {
            $nifCorrecte = TRUE;
        }
    }
    return $nifCorrecte;
}

function esCodiPostal($codiPostalAVerificar) {
    if ((strlen($codiPostalAVerificar) == 5) && (is_numeric($codiPostalAVerificar))) {
        $esCP = true;
    } else {
        $esCP = false;
    }
    return $esCP;
}

function esProvincia($provinciaAVerificar) {
    $provincias = array('alava', 'arava','albacete','alacant','alicante','almería','asturias','avila','badajoz','barcelona','burgos','cáceres',
        'cádiz','cantabria','castelló','castellón','ciudad real','córdoba','la coruña','cuenca','girona','gerona','granada','guadalajara',
        'guipuzkoa','guipúzcoa','huelva','huesca','illes balears','islas baleares','jaén','león','lleida','lérida','lugo','madrid','málaga','murcia','navarra',
        'orense','palencia','las palmas','pontevedra','la rioja','salamanca','segovia','sevilla','soria','tarragona',
        'santa cruz de tenerife','teruel','toledo','valència','valencia','valladolid','bizkaia','vizcaya','zamora','zaragoza');
    if (in_array($provinciaAVerificar,$provincias)) {
        $esUnProvincia = true;
    } else {
        $esUnProvincia = false;
    }
    return $esUnProvincia;
}

if ($_SERVER['REQUEST_METHOD']=='POST' && (isset($_POST['submit']))) {
    $email          = sanitize($_POST["email"]);
    $password       = sanitize($_POST["pass"]);
    $cpassword      = sanitize($_POST["cpass"]);
    
    $tipusIdent     = sanitize($_POST["tipus"]);
    $numeroIdent    = strtoupper(sanitize($_POST["dni"]));
    $nom            = strtoupper(sanitize($_POST["nom"]));
    $cognoms        = strtoupper(sanitize($_POST["cognoms"]));
    $sexe           = sanitize($_POST["sexe"]);
    $naixement      = sanitize($_POST["naixement"]);
    
    $adreca         = sanitize($_POST["adreca"]);
    $codiPostal     = sanitize($_POST["cp"]);
    $poblacio       = sanitize($_POST["poblacio"]);
    $provincia      = sanitize($_POST["provincia"]);
    $telefon        = sanitize($_POST["telefon"]);
    
    $iniciCadena    = strpos($_SERVER["HTTP_USER_AGENT"], "(") + 1;
    $finalCadena    = strpos($_SERVER["HTTP_USER_AGENT"], ")") - 1;
    
    $navegador      = substr($_SERVER["HTTP_USER_AGENT"], 0, strpos($_SERVER["HTTP_USER_AGENT"], "("));
    $plataforma     = substr($_SERVER["HTTP_USER_AGENT"], $iniciCadena, $finalCadena - $iniciCadena);
    
    if ($errorsDetectats===null) {
        $imatge = sanitize($_FILES['imatge']['name']);
    }
    
    if ($email == "") {
        $errorsDetectats["email"] = "l'email és una dada obligatòria, si us plau indica-la.";
    } else {
        if (! validateItem($email, "email")) {
            $errorsDetectats["email"] = "l'email no té un format adient.";
        } 
    }
    
    if (($password == "") || ($cpassword == "")) {
        $errorsDetectats["pass"] = "El password és una dada obligatòria, si us plau indica-la.";
    } else {
        if ($password != $cpassword) {
            $errorsDetectats["cpass"] = "La repetició del password no correspon amb el password entrat.";
        }
    }
    
    $tipusValids = array ("NIF", "NIE", "PAS");
    if (! in_array($tipusIdent,$tipusValids)) {
        $errorsDetectats["tipus"] = "Hi ha algun error amb el tipus";
    } 
    
    if ($numeroIdent == "") {
        $errorsDetectats["dni"] = "El dni és una dada obligatòria, si us plau indica-la.";
    } else {
        if (($tipusIdent != "pas") && (! validarNif($numeroIdent))) {
            $errorsDetectats["dni"] = "El dni no té un format correcte.";
        } 
    }
    
    if ($nom == "") {
        $errorsDetectats["nom"] = "El nom és una dada obligatòria, si us plau indica-la.";
    } else {
        if (! validateItem($nom, "alfanum")) {
            $errorsDetectats["nom"] = "El nom no té un format correcte.";
        } 
    }
    
    if ($cognoms == "") {
        $errorsDetectats["cognoms"] = "El nom és una dada obligatòria, si us plau indica-la.";
    } else {
        if (! validateItem($cognoms, "alfanum")) {
            $errorsDetectats["cognoms"] = "Els cognoms no tenen un format correcte.";
        } 
    }    

    $tipusValids = array ("H", "D");
    if (! in_array($sexe, $tipusValids)) {
        $errorsDetectats["sexe"] = "Hi ha hagut algun problema amb la seleccio de sexe.";
    }
    
    if ($naixement == "") {
        $errorsDetectats["dNaixement"] = "La data de naixement és una dada obligatòria, si us plau indica-la.";
    } 
    
    if (($cp != "") && (! esCodiPostal($cpP))) {
        $errorsDetectats["cp"] = "Els codi postal no correspon a cap població.";
    } 
    
    if (($provincia != "") && (! esProvincia(strtolower($provincia)))) {
        $errorsDetectats["provincia"] = "La provincia no és una de les espanyoles.";
    } 
    
    if (($telefon != "") && (! validateItem($telefon,"phone"))) {
        $errorsDetectats["telefon"] = "El format del telèfon no és correcte.";
    } 
    
    if (!isset($errorsDetectats)) {
        $directoriDePujades ="../uploads/";			//carpeta on emmagatzemearem les imatges pujades pels usuaris
        $formatsImatgesPermesos = array('jpg','jpeg','gif','png','tif','tiff','bmp');		  	//formats permesos
        $mimesImatgesPermesos = array ("image/jpg", "image/jpeg", "image/png", "image/gif", "image/tif", "image/tiff", "image/bmp");
        
        if ($_FILES['imatge']['error'] == 0) { // Si hi ha foto ....
            $imatge = $_FILES['imatge']['tmp_name']; // carreguem el nom temporal del fitxer
            $nomOriginal = $_FILES['imatge']['name']; // carreguem el nom original
            $sImatge = $nomOriginal;
            $tamany = $_FILES['imatge']['size']; // carreguem el tamany del fitxer en bytes
            $error = $_FILES['imatge']['error']; // carreguem el tamany del fitxer en bytes
            $tipus = $_FILES['imatge']['type']; // carreguem el tipus mime del fitxer en bytes
            
            if ($error === 0) {
                $aNom = explode('.', $nomOriginal); // Busquem l'extensió del fitxer
                $aNomLong = count($aNom); // ens diu quants elements té l'array
                $sExtensio = strtolower($aNom[-- $aNomLong]);
                
                // Verifiquem si hi ha errors en la pujada del fitxer:
                if (in_array($sExtensio, $formatsImatgesPermesos)) { // format incorrecte per extensió
                    if (in_array($tipus, $mimesImatgesPermesos)) { // format incorrecte per mime
                        if ($tamany > 2097152) { // tamany massa gran
                            $errorsDetectats["imatge"] = "Error2013 - Tamany excessiu del fitxer";
                        } else {
                            $nomNou = microtime(true) . '_' . $nomOriginal; // Afegim l'hora per fer un fitxer únic
                            $rutaNova = $directoriDePujades . $nomNou; // Afegim el path al nom del fitxer
                            $result = move_uploaded_file($imatge, $rutaNova); // Movem el fitxer a la carpeta
                            
                            if ($result) {
                                $imatge = $rutaNova;
                            } else {
                                $errorsDetectats["imatge"] = "Error2014 - Problemes al moure el fitxer definitiu";
                            }
                        }
                    } else {
                        $errorsDetectats["imatege"] = "Error2012 - El format intern del fitxer no està permés";
                    }
                } else {
                    $errorsDetectats["imatge"] = "Error2011 - Tipus de fitxer amb extensió no permesa";
                }
            } else {
                // Si s'ha intentat pujar un fitxer però ha donat error.
                // Si no s'ha pujat.... tot ok
                if ($_FILES['imatge']['error'] != 4) {
                    $errorsDetectats["imatge"] = "Error2010 - No ha pujat el fitxer. Error: " . $error;
                }
            }
        }
    }
    
    if (isset($errorsDetectats)) {
        $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
    } else {
        $sNom       = $nom;
        $sCognoms   = $cognoms;
        $idDelRegistreInsertat = $id;
        
        $titol = "Procès finalitzat correctament";
        $missatge = "Benvolgut/da $sNom $sCognoms<br>
    Ens complau donar-te la benvinguda a la nova aplicació mòbil de residents des de la qual podràs realitzar el pagament mitjançant un telèfon smartphone quan estacionis el teu vehicle a la teva zona de resident de l’AREA de Barcelona sense la necessitat d’anar al parquímetre.<br>
    Per procedir a l’activació del compte has de prémer el següent <a href='?user/confirmacio/$idDelRegistreInsertat'>enllaç</a>.<br>
    Recorda que pots obtenir ajuda i tota la informació sobre el funcionament de l’aplicació mòbil ONaparcar Residents accedint a la secció preguntes freqüents i que en cas d’ incidència ens ho pots notificar mitjançant el formulari de suport tècnic.<br>
    <br>
    Atentament, ";

    }
}


$options = ["type"=>"text",
    "name"=>"email",
    "placeholder"=>"email (Obligatori)",
    "class"=>"llarg",
    "value"=> $email,
    "span"=> $errorsDetectats===null ? "" : $errorsDetectats["email"] ];
$input_email = html_generaInput($options);

$options = [
    "type"=>"password",
    "name"=>"pass",
    "placeholder"=>"Contrasenya (Obligatori)",
    "class"=>"llarg",
    "value"=>$password,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["pass"] ];
$input_pass = html_generaInput($options);

$options = [
    "type"=>"password",
    "name"=>"cpass",
    "placeholder"=>"Confirma la contrasenya (Obligatori)",
    "class"=>"llarg",
    "value"=>$cpassword,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["cpass"] ];
$input_cpass = html_generaInput($options);

$options = [
    "type"=>"button",
    "name"=>"next",
    "class"=>"next action-button",
    "value"=>"Next" ];
$input_bNext = html_generaInput($options);

$atributs = [
    "class"=>"curt",
    "name"=>"tipus",
    "span"=>$errorsDetectats=== null ? "" : $errorsDetectats["tipus"] ];
$opcions = [
    "NIF"=>"NIF: Número d'Identificació Fiscal",
    "NIE"=>"NIE: Número d'Identificació d'Extranjers",
    "PAS"=>"PAS: Passaport" ];
$seleccionat = ($tipusIdent!==null) ? $tipusIdent : "NIF";
$select_Tipus = html_generateSelect($opcions, $seleccionat, $atributs);

//         var_dump($select_Tipus);
//         die;

$options = [
    "type"=>"text",
    "name"=>"dni",
    "placeholder"=>"DNI (Obligatori)",
    "class"=>"curt",
    "value"=> $numeroIdent,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["dni"] ];
$input_dni = html_generaInput($options);

$options = [
    "type"=>"text",
    "name"=>"nom",
    "placeholder"=>"Nom (Obligatori)",
    "class"=>"llarg",
    "value"=>$nom,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["nom"] ];
$input_nom = html_generaInput($options);

$options = [
    "type"=>"text",
    "name"=>"cognoms",
    "placeholder"=>"Cognoms (Obligatori)",
    "class"=>"llarg",
    "value"=>$cognoms,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["cognoms"]  ];
$input_cognoms = html_generaInput($options);

$opcions = [
    "sexe1" => [
        "name" => "sexe",
        //"class" => "curt",
        "value" => "H",
        "checked"=>($sexe=="H") ? true : false,
        "label"=>"Home" ] ,
    "sexe2" => [
        "name" => "sexe",
        //"class" => "curt",
        "value" => "D",
        "checked"=>($sexe=="D") ? true : false,
        "label"=>"Dona" ]
];
$select_Sexe = html_generateRadioButon($opcions);


$options = [
    "type"=>"text",
    "name"=>"naixement",
    "placeholder"=>"Data de naixement (Obligatori)",
    "class"=>"llarg",
    "value"=>$naixement,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["dNaixement"] ];
$input_naixement = html_generaInput($options);

$options = [
    "type"=>"button",
    "name"=>"previous",
    "class"=>"previous action-button",
    "value"=>"Previous" ];
$input_bPrev = html_generaInput($options);

$options = [
    "class"=>"llarg",
    "name"=>"adreca",
    "placeholder"=>"Adreça",
    "value"=>$adreca,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["adreca"] ];
$input_adreca = html_generaInput($options);

$options = [
    "class"=>"llarg",
    "class"=>"curt",
    "name"=>"cp",
    "placeholder"=>"C.P.",
    "value"=>$codiPostal,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["cp"]  ];
$input_cp = html_generaInput($options);

$options = [
    "class"=>"llarg",
    "class"=>"curt",
    "name"=>"poblacio",
    "placeholder"=>"Població",
    "value"=>$poblacio,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["poblacio"] ];
$input_poblacio = html_generaInput($options);

$options = [
    "class"=>"llarg",
    "class"=>"curt",
    "name"=>"provincia",
    "placeholder"=>"Provincia",
    "value"=>$provincia,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["provincia"] ];
$input_provincia = html_generaInput($options);

$options = [
    "class"=>"llarg",
    "class"=>"curt",
    "name"=>"telefon",
    "placeholder"=>"Teléfon",
    "value"=>$telefon,
    "span"=>$errorsDetectats===null ? "" : $errorsDetectats["telefon"] ];
$input_telefon = html_generaInput($options);

$options = [
    "type"=>"hidden",
    "name"=>"MAX_FILE_SIZ",
    "value"=>"2097152" ];
$input_maxFileSize = html_generaInput($options);

$options = [
    "type"=>"file",
    "class"=>"llarg",
    "name"=>"imatge",
    "id"=>"imatge",
    "value"=>$imatge,
    "span"=>$errorsDetectats==null ? "" : $errorsDetectats["imatge"] ];
$input_imatge = html_generaInput($options);

$options = [
    "type"=>"submit",
    "name"=>"submit",
    "class"=> "submit action-button",
    "value"=> "Envia Dades"];
$input_bSend = html_generaInput($options);


?>

<!DOCTYPE html>
<html lang="en">
<?php include "../inc/head.php"; ?>
<body>
	<main>
		<?php
		$menu_actiu="principal";
		include "../inc/main-menu.php"; 
		?>


		<div class="left-content">
		<?php include "../inc/div_left_registre.php"; ?>			
		</div>
		
		
	</main>
</body>
</html>
