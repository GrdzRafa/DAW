<?php

class ContacteModel {
    public const FILE = __ROOT__ . "files/contacta.xml";
    private $contingut;

    public function __construct() {
        $contingut = file_get_contents(self::FILE);
        
         if ($contingut === false) {
            $this->contingut = "<contactes>";
        } elseif (strlen($contingut)>0) {
            $this->contingut = substr($contingut, 0, -12);
        } else {
            $this->contingut = "<contactes>";
        }
    }
    
    public function set(ContacteModel $contacte) {
        $avui = getdate();
        $contingut = $this->contingut;
        $contingut .= "<contacte><data>{$avui['mday']}/{$avui['mon']}/{$avui['year']}</data>\n";
        $contingut .= "<nom>".html_entity_decode($contacte->__get("nom"))."</nom>\n";
        $contingut .= "<email>".html_entity_decode($contacte->__get("email"))."</email>\n";
        $contingut .= "<telefon>".html_entity_decode($contacte->__get("telefon"))."</telefon>\n";
        $contingut .= "<assumpte>".html_entity_decode($contacte->__get("assumpte"))."</assumpte>\n";
        $contingut .= "<missatge>".html_entity_decode($contacte->__get("missatge"))."</missatge>\n";
        $contingut .= "</contacte></contactes>";
        if (!file_put_contents(self::FILE, $contingut)) {
            throw new Exception("Problemes d'escriptura en el fitxer de contactes");
        }
    }
    
    public function __destruct() {
        
    }
}

