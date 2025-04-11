<?php

class UserController extends Controller{
    private $user;
    
    public function __construct() {
        $this->user = new Usuari();
    }
    
    public function log_in() {
        $vUser = new UserView();
        $vUser->show();
    }
    
    public function log_out() {
        session_destroy();
        header("location:index.php");
        exit;
    }
    
    public function form_log_in($params) {
        if (isset($params["log-in"]) && $params["log-in"]=="Entra") {
            $this->post_log_in($params);
        } elseif (isset($params["registre"]) && $params["registre"]=="Registre") {
            header("location:index.php?user/registre");
            exit;
        }
    }
    
    private function post_log_in($params) {
        if (strlen($params["email"]) == 0) {
            $error["email"]="l'email és obligatori";
        } else {            
            if ($this->validateItem($params["email"],"email")) {
                $mail = $this->sanitize($params["email"],"email");
            } else {
                $error["email"]="email no vàlid";
            }
        }
        if (strlen($params["password"]) == 0) {
            $error["password"]="la contrasenya és obligatoria";
        } else {
            $pass = $this->sanitize($params["password"]);
        }
        
        $this->user->email = $mail;
        $this->user->setPassword($pass);
        $this->user->errorsDetectats = (isset($error)) ? $error : null;
        
        if (!isset($error)) {
            if ($this->user->get($mail)) {
                // L'usuari existeix a la BBDD
                // Verifico el password                
                if ($pass==$this->user->getPassword()) {
                    // Uusari i password correctes
                    // Verifico l'estat
                    if ($this->user->status==0) {
                        $this->user->errorsDetectats["conn"]="Usuari no activat";
                    } else if ($this->user->status==1){
                        $_SESSION["user"] = "{$this->user->nom} {$this->user->cognoms}";
                        $_SESSION["user_id"] = "{$this->user->getId()}";
                        $_SESSION["img"] = "{$this->user->imatge}";
                        header("location:index.php");
                        exit;
                    }
                } else {
                    $this->user->setPassword("");
                    $this->user->errorsDetectats["password"]="Contrasenya errònia";
                }
            }  else {
                $this->user->errorsDetectats["conn"]="Usuari no registrat";
            }
        } 
        
        $vUser = new UserView();
        $vUser->show($this->user);
    }
    
    public function registre($params) {
        $vUser = new UserView();
        $vUser->registre();
    }
    
    public function form_registre($params) {
        $email          = $this->sanitize($params["email"]);
        $password       = $this->sanitize($params["pass"]);
        $cpassword      = $this->sanitize($params["cpass"]);
        
        $tipusIdent     = $this->sanitize(strtoupper($params["tipus"]));
        $numeroIdent    = strtoupper($this->sanitize($params["dni"]));
        $nom            = strtoupper($this->sanitize($params["nom"]));
        $cognoms        = strtoupper($this->sanitize($params["cognoms"]));
        $sexe           = $this->sanitize(strtoupper($params["sexe"]));
        $naixement      = $this->sanitize($params["naixement"]);
        
        $adreca         = $this->sanitize($params["adreca"]);
        $codiPostal     = $this->sanitize($params["cp"]);
        $poblacio       = $this->sanitize($params["poblacio"]);
        $provincia      = $this->sanitize($params["provincia"]);
        $telefon        = $this->sanitize($params["telefon"]);
        
        $iniciCadena    = strpos($_SERVER["HTTP_USER_AGENT"], "(") + 1;
        $finalCadena    = strpos($_SERVER["HTTP_USER_AGENT"], ")") - 1;
        
        $navegador      = substr($_SERVER["HTTP_USER_AGENT"], 0, strpos($_SERVER["HTTP_USER_AGENT"], "("));
        $plataforma     = substr($_SERVER["HTTP_USER_AGENT"], $iniciCadena, $finalCadena - $iniciCadena);
        
        $imatge = $this->sanitize($_FILES['imatge']['name']);
        
        $usuari = new Usuari();
        
        if (strlen($email) == 0) {
            $errorsDetectats["email"] = "l'email és una dada obligatòria, si us plau indica-la.";
        } else {
            if (! $this->validateItem($email, "email")) {
                $errorsDetectats["email"] = "l'email no té un format adient.";
            } else {
                $usuari->email = $email;
            }
        }
        
        if ((strlen($password) == 0) || (strlen($cpassword) == 0)) {
            $errorsDetectats["pass"] = "El password és una dada obligatòria, si us plau indica-la.";
        } else {
            if ($password != $cpassword) {
                $errorsDetectats["cpass"] = "La repetició del password no correspon amb el password entrat.";
            } else {
                $usuari->setPassword($password);
            }
        }
        
        $tipusValids = array ("NIF", "NIE", "PAS");
        if (! in_array($tipusIdent,$tipusValids)) {
            $errorsDetectats["tipus"] = "Hi ha algun error amb el tipus";
        } else {
            $usuari->tipusIdent = $tipusIdent;
        }
        
        if (strlen($numeroIdent) == 0) {
            $errorsDetectats["dni"] = "El dni és una dada obligatòria, si us plau indica-la.";
        } else {
            if (($tipusIdent != "PAS") && (! $this->validarNif($numeroIdent))) {
                $errorsDetectats["dni"] = "El dni no té un format correcte.";
            } else {
                $usuari->numeroIdent = $numeroIdent;
            }
        }
        
        if (strlen($nom) == 0) {
            $errorsDetectats["nom"] = "El nom és una dada obligatòria, si us plau indica-la.";
        } else {
            if (! $this->validateItem($nom, "alfanum")) {
                $errorsDetectats["nom"] = "El nom no té un format correcte.";
            } else {
                $usuari->nom = $nom;
            }
        }
        
        if ($cognoms == "") {
            $errorsDetectats["cognoms"] = "El nom és una dada obligatòria, si us plau indica-la.";
        } else {
            if (! $this->validateItem($cognoms, "alfanum")) {
                $errorsDetectats["cognoms"] = "Els cognoms no tenen un format correcte.";
            } else {
                $usuari->cognoms = $cognoms;
            }
        }
        
        $tipusValids = array ("H", "D");
        if (! in_array($sexe, $tipusValids)) {
            $errorsDetectats["sexe"] = "Hi ha hagut algun problema amb la seleccio de sexe.";
        } else {
            $usuari->sexe = $sexe;
        }
        
        if (strlen($naixement) == 0) {
            $errorsDetectats["dNaixement"] = "La data de naixement és una dada obligatòria, si us plau indica-la.";
        } else {
            $usuari->datanaixement=$naixement;
        }
        
        if (strlen($adreca)!=0) {
            $usuari->adreca = $adreca;
        }
        
        if ((strlen($codiPostal) != 0) && (! $this->esCodiPostal($codiPostal))) {
            $errorsDetectats["cp"] = "Els codi postal no correspon a cap població.";
        } else {
            if (strlen($codiPostal)!=0) {
                $usuari->codiPostal=$codiPostal;
            }
        }
        
        if ((strlen($provincia) != 0) && (! $this->esProvincia(strtolower($provincia)))) {
            $errorsDetectats["provincia"] = "La provincia no és una de les espanyoles.";
        } else {
            if (strlen($provincia)!=0) {
                $usuari->provincia=$provincia;
            }
        }
        
        $usuari->poblacio = $poblacio;
        
        if ((strlen($telefon) != 0) && (! $this->validateItem($telefon,"phone"))) {
            $errorsDetectats["telefon"] = "El format del telèfon no és correcte.";
        } else {
            if (strlen($telefon)!=0) {
                $usuari->telefon=$telefon;
            }
        }
      
        if (!isset($errorsDetectats)) {
            $directoriDePujades = "../uploads/";	        //carpeta on emmagatzemearem les imatges pujades pels usuaris
            $formatsImatgesPermesos = array('jpg','jpeg','gif','png','tif','tiff','bmp');		  	//formats permesos
            $mimesImatgesPermesos = array ("image/jpg", "image/jpeg", "image/png", "image/gif", "image/tif", "image/tiff", "image/bmp");
            
            if ($_FILES['imatge']['error'] == 0) {          // Si hi ha foto ....
                $imatge = $_FILES['imatge']['tmp_name'];    // carreguem el nom temporal del fitxer
                $nomOriginal = $_FILES['imatge']['name'];   // carreguem el nom original
                $sImatge = $nomOriginal;
                $tamany = $_FILES['imatge']['size'];        // carreguem el tamany del fitxer en bytes
                $error = $_FILES['imatge']['error'];        // carreguem el tamany del fitxer en bytes
                $tipus = $_FILES['imatge']['type'];         // carreguem el tipus mime del fitxer en bytes
                
                if ($error === 0) {
                    $aNom = explode('.', $nomOriginal);     // Busquem l'extensió del fitxer
                    $aNomLong = count($aNom);               // ens diu quants elements té l'array
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
                                    $usuari->imatge = $rutaNova;
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

        //Les dades del formulari cón correctes. Verifiquem les dades a la BBDD abans
        //d'actualitzar.
        $bdUsuari = new Usuari();
        if ($bdUsuari->get($usuari->email)) {
            $errorsDetectats["email"]="Aquest email ja existeix a la meva base de dades";
        } 
 
        if (isset($errorsDetectats)) {
            $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
            $usuari->errorsDetectats = $errorsDetectats;
            
            $vista = new UserView();
            $vista->registre($usuari);           
            
        } else {
            $usuari->set();
            $usuari->get($email);
            
            $titol = "Procès finalitzat correctament";
            $missatge = "Benvolgut/da {$usuari->nom} {$usuari->cognoms}<br>
    Ens complau donar-te la benvinguda a la nova aplicació mòbil de residents des de la qual podràs realitzar el pagament mitjançant un telèfon smartphone quan estacionis el teu vehicle a la teva zona de resident de l’AREA de Barcelona sense la necessitat d’anar al parquímetre.<br>
    Per procedir a l’activació del compte has de prémer el següent <a href='?user/confirmacio/{$usuari->getId()}'>enllaç</a>.<br>
    Recorda que pots obtenir ajuda i tota la informació sobre el funcionament de l’aplicació mòbil ONaparcar Residents accedint a la secció preguntes freqüents i que en cas d’ incidència ens ho pots notificar mitjançant el formulari de suport tècnic.<br>
    <br>
    Atentament, ";
            
            $vista = new MessageView();
            $vista->show($titol, $missatge);
        }
    }
    
    public function confirmacio($param) {
        if (!isset($param)) {
            throw new Exception("Falten dades per la confirmació");
        }
        $this->user=new Usuari();
        $this->user->edit(array('id'=>$param[0],'status'=>1));
        
        $this->user->getOneById($param[0]);
       
        if ($this->user->getId()==$param[0] && $this->user->status==1) {
            $titol = "Procès finalitzat correctament";
            $missatge = "Benvolgut/da {$usuari->nom} {$usuari->cognoms}<br>
    Ens complau donar-te la benvinguda a la nova aplicació mòbil de residents des de la qual podràs realitzar el pagament mitjançant un telèfon smartphone quan estacionis el teu vehicle a la teva zona de resident de l’AREA de Barcelona sense la necessitat d’anar al parquímetre.<br><br><br><br>
    Ja estàs validat a l'aplicació, i a partir d'ara ja tens accés a tota la operativa.
    <br>
    Atentament, ";
            
            $vista = new MessageView();
            $vista->show($titol, $missatge);
        } else {
            throw new Exception("No he pogut canviar l'status del registre {$param[0]}");
        }
        
    }
    
    public static function validarNif ($nif) {
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
    
    public static function esCodiPostal($codiPostalAVerificar) {
        if ((strlen($codiPostalAVerificar) == 5) && (is_numeric($codiPostalAVerificar))) {
            $esCP = true;
        } else {
            $esCP = false;
        }
        return $esCP;
    }
    
    public static function esProvincia($provinciaAVerificar) {
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
}

