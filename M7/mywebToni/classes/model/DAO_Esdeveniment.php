<?php

class DAO_Esdeveniment {
    private $table = "tbl_esdeveniments"; 
    private $connexio;
    
    public function __construct() {
        $this->connexio = BaseDeDades::getInstance();
    }

    public function __destruct() {
        $this->connexio=null;
    }
    
    public function create(ON_Esdeveniment $toCreate) {
        $sSql = "INSERT INTO {$this->table} (inici_data,inici_hora,fi_data,titol,contingut)";        
        $sSql .= " VALUES (?,?,?,?,?);";
        
        $inici_hora=($toCreate->horaInici=="") ? NULL : $toCreate->horaInici;
        $fi_data=($toCreate->final=="") ? NULL : $this->string2date($toCreate->final);
        $contingut=($toCreate->contingut=="") ? NULL : $toCreate->contingut;
        $sParam = array(
            $this->string2date($toCreate->dataInici),
            $inici_hora,
            $fi_data,
            $toCreate->titol,
            $contingut
        );
        
        if ($this->connexio->executarSQL($sSql,$sParam)) {
            return $this->connexio->getLink()->insert_id;
        } else {
            throw new Exception("Hi ha un error en al consulta a la BBDD: " . $this->connexio->getLink()->getLastError());
        }
    }
    
    public function update(ON_Esdeveniment $toCreate) {
        $sSql = "UPDATE {$this->table} SET inici_data=?,inici_hora=?,fi_data=?,titol=?,contingut=?";
        $sSql .= " WHERE id = ?;";
        
        $inici_hora=($toCreate->horaInici=="") ? NULL : $toCreate->horaInici;
        $fi_data=($toCreate->final=="") ? NULL : $this->string2date($toCreate->final);
        $contingut=($toCreate->contingut=="") ? NULL : $toCreate->contingut;
        $sParam = array(
            $this->string2date($toCreate->dataInici),
            $inici_hora,
            $fi_data,
            $toCreate->titol,
            $contingut,
            $toCreate->id
        );
        
        if ($this->connexio->executarSQL($sSql,$sParam)) {
            return $this->connexio->getLink()->insert_id;
        } else {
            throw new Exception("Hi ha un error en al consulta a la BBDD: " . $this->connexio->getLink()->getLastError());
        }
    }
    
    public function getAll() {
        $sSql = "SELECT * FROM {$this->table} ORDER BY inici_data";
        
        foreach ($this->connexio->executarSQL($sSql,array()) as $registre) {
            $esdeveniment = new ON_Esdeveniment();
            $esdeveniment->id = $registre["id"];
            $esdeveniment->dataInici = $this->date2string($registre["inici_data"]);
            $esdeveniment->horaInici = $registre["inici_hora"];
            $esdeveniment->final = $this->date2string($registre["fi_data"]);
            $esdeveniment->titol = $registre["titol"];
            $esdeveniment->contingut = $registre["contingut"];
            
            $esdeveniments[] = $esdeveniment;
        }
        
        return $esdeveniments;
    }
    
    public function getOneById($id) {
        $sSql = "SELECT * FROM {$this->table} WHERE id = ?";
        
        $registre = $this->connexio->executarSQL($sSql,array($id));

        if (count($registre)==1) {
            $esdeveniment = new ON_Esdeveniment();
            $esdeveniment->id = $registre[0]["id"];
            $esdeveniment->dataInici = $this->date2string($registre[0]["inici_data"]);
            $esdeveniment->horaInici = $registre[0]["inici_hora"];
            $esdeveniment->final = $this->date2string($registre[0]["fi_data"]);
            $esdeveniment->titol = $registre[0]["titol"];
            $esdeveniment->contingut = $registre[0]["contingut"];
        } else {
            $esdeveniment = false;
        }
      
        return $esdeveniment;
    }
    
    public function getBetweenDates($from, $to) {
        $sSql = "SELECT * FROM {$this->table} WHERE inici_data BETWEEN ? AND ? ORDER BY inici_data";
        
        $registres = $this->connexio->executarSQL($sSql,array($from,$to));

        foreach ($registres as $registre) {
            $esdeveniment = new ON_Esdeveniment();
            $esdeveniment->id = $registre["id"];
            $esdeveniment->dataInici = $this->date2string($registre["inici_data"]);
            $esdeveniment->horaInici = $registre["inici_hora"];
            $esdeveniment->final = $this->date2string($registre["fi_data"]);
            $esdeveniment->titol = $registre["titol"];
            $esdeveniment->contingut = $registre["contingut"];
            
            $esdeveniments[] = $esdeveniment;
        }
        
        return $esdeveniments;
    }
    
    public function delete($id) {
        $sSql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->connexio->executarSQL($sSql,array($id));
    }
    
    private function string2date($cadena) {
        if ($cadena==NULL) {
            return ;
        } ELSE {
            $dia = substr($cadena,0,2);
            $mes = substr($cadena,3,2);
            $any = substr($cadena,6);
            return "$any-$mes-$dia";
        }
    }
    
    private function date2string($cadena) {
        if ($cadena==NULL) {
            return ;
        } else {
            $data = explode("-",$cadena);
            $any = $data[0];
            $mes = str_pad($data[1], 2, "0", STR_PAD_LEFT);
            $dia = str_pad($data[2], 2, "0", STR_PAD_LEFT);
            return "$dia/$mes/$any";
        }
    }
}