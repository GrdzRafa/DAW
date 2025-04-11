<?php
class DAO_Phrases {
    private $_pdo;

    public function __construct()    {
        $mConfig = Configuracio::getInstance();
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH // make the default fetch be an associative and numeric array
        ];
        $this->_pdo = new PDO("mysql:host=localhost;dbname=frases", $mConfig->getUsername(), $mConfig->getPassword(), $options);
    }

    public function create(ON_Phrase $newFrase)  {
        if (! isset($newFrase)) {
            throw new Exception("Impossible crear frase buida");
        }
        if ($this->getById($newFrase->getId()) != null) {
            throw new Exception("Ja existeix una Frase amb la clau {$newFrase->getId()}");
        }
        
        $preparedStmtMax = $this->_pdo->prepare("SELECT MAX(id) FROM tbl_frases");
        $preparedStmtMax->execute(array());
        $registre = $preparedStmtMax->fetch();
        $regSeguent = $registre[0] + 1;

        $preparedStmt = $this->_pdo->prepare("INSERT INTO tbl_frases (id, text, tema_id, autor_id) VALUES (?, ?, ?, ?)");
        $preparedStmt->execute(array(
            $regSeguent,
            $newFrase->getText(),
            $newFrase->getTema()->getId(),
            $newFrase->getAutor()->getId()
        ));
        if ($preparedStmt->errorCode() != 0) {
            throw new Exception("Impossible crear frase " . $params[0] . "per error " . $preparedStmt->errorInfo());
        }
    }

    public function read($registresPerPagina, $offSet) {        
        $resultat = false;
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();

        $preparedStmtFrases = $this->_pdo->prepare("SELECT * FROM tbl_frases ORDER BY id LIMIT " . $registresPerPagina . " OFFSET " . $offSet);
        $preparedStmtFrases->execute();

        $resultat=[];
        while ($registre = $preparedStmtFrases->fetch()) {
             $resultat[] = new ON_Phrase(
                 $registre['id'], 
                 $registre['text'], 
                 $mTemes->getById($registre['tema_id']),
                 $mAutors->getById($registre['autor_id'])
             );
        }

        return $resultat;
    }

    public function readByTema(ON_Theme $tema, $registresPerPagina, $offSet) {
        if (! isset($tema)) {
            throw new Exception("Impossible llegir frases per tema sense tema");
        }
        $resultat = false;
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        
        $preparedStmtFrases = $this->_pdo->prepare("SELECT * FROM tbl_frases WHERE tema_id=? ORDER BY id LIMIT " . $registresPerPagina . " OFFSET " . $offSet);
        $preparedStmtFrases->execute(array($tema->getId()));
        
        while ($registres[] = $preparedStmtFrases->fetchObject());
        array_pop($registres);
        
        $resultat=array();
        foreach ($registres as $registre) {
            $resultat[] = new ON_Phrase(
                $registre->id,
                $registre->text,
                $mTemes->getById($registre->tema_id),
                $mAutors->getById($registre->autor_id)
                );
        }
        
        return $resultat;
    }
    
    public function readByAutor(ON_Author $autor, $registresPerPagina, $offSet) {
        if (! isset($autor)) {
            throw new Exception("Impossible llegir frases per autor sense autor");
        }
        $resultat = false;
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        
        $preparedStmtFrases = $this->_pdo->prepare("SELECT * FROM tbl_frases WHERE autor_id=? ORDER BY id LIMIT " . $registresPerPagina . " OFFSET " . $offSet);
        $preparedStmtFrases->execute(array($autor->getId()));
        
        while ($registres[] = $preparedStmtFrases->fetchObject());
        array_pop($registres);
        
        $resultat=array();
        foreach ($registres as $registre) {
            $resultat[] = new ON_Phrase(
                $registre->id,
                $registre->text,
                $mTemes->getById($registre->tema_id),
                $mAutors->getById($registre->autor_id)
                );
        }
        return $resultat;
    }
    
    
    public function update(ON_Phrase $fraseToUpdate) {
        if (! isset($fraseToUpdate)) {
            throw new Exception("Impossible actualitzar frase buit");
        }
        if ($this->getById($fraseToUpdate->getId()) == null) {
            throw new Exception("No existeix una frase amb la clau {$fraseToUpdate->getId()}");
        }
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        
        $stmtFrase = $this->_pdo->prepare("UPDATE tbl_frases SET text=?, tema_id=?, autor_id=? WHERE id=?");
        $res = $stmtFrase->execute(array(
            $fraseToUpdate->gettext(),
            $fraseToUpdate->getTema()->getId(),
            $fraseToUpdate->getAutor()->getId(),
            $fraseToUpdate->getId()
        ));
    }
    
    public function delete(ON_Phrase $fraseToDelete)     {
        if (! isset($fraseToDelete)) {
            throw new Exception("Impossible esborrar frase buida");
        }
        if ($this->getById($fraseToDelete->getId()) == null) {
            throw new Exception("No existeix una frase amb la clau {$fraseToDelete->getId()}");
        }
            $stmtFrase = $this->_pdo->prepare("DELETE FROM tbl_frases WHERE id=?");
            if ($res = $stmtFrase->execute(array(
                $fraseToDelete->getId()
            ))) {
                return true;
            } else {
                throw new Exception("Problemes a l'esborrar la frase {$fraseToDelete->getId()}" . $stmtAutor->errorCode(), "AutorController linia 47 ");
            }
 
    }

    public function count($where=null)    {
        try {
            $stmt="SELECT COUNT(*) FROM tbl_frases";
            if (isset($where["tema"])) {
                $stmt .= " WHERE tema_id=?";
                $param = array($where["tema"]);
            } elseif (isset($where["autor"])) {
                $stmt .= " WHERE autor_id=?";
                $param = array($where["autor"]);
            } else {
                $param = array();
            }
            $stmtNumeroFrases = $this->_pdo->prepare($stmt);
            $stmtNumeroFrases->execute($param);
            $result=$stmtNumeroFrases->fetch()[0];
        }catch (PDOException $e) {
            $result=0;
        }
        return $result;
    }

    public function getById($id)    {
        if (! isset($id)) {
            throw new Exception("FrasesModel->getById sense id");
        }
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        
        $preparedStmtFrases = $this->_pdo->prepare("SELECT * FROM tbl_frases WHERE id=?");
        $preparedStmtFrases->execute(array(
            $id
        ));

        if ($registre = $preparedStmtFrases->fetch()) {             
            $result = new ON_Phrase($registre['id'], $registre['text'], $mTemes->getById($registre['tema_id']), $mAutors->getById($registre['autor_id']));
        } else {
            $result=null;
        }
        return $result;
    }

    public function generate() {
        $this->_pdo->exec("drop database if exists frases;");
        $this->_pdo->exec("create database frases default character set utf8 default collate utf8_general_ci;");
        $this->_pdo->exec("use frases");
        
        $this->_pdo->exec("create table tbl_autors (
			 	id			integer  	primary key,
                url         varchar(100),
			 	nom    		varchar(50) not null,
			 	descripcio  varchar(200) not null);");
        
        $this->_pdo->exec("create table tbl_temes (
			 	id			integer  	primary key,
 				nom    		varchar(50) not null);");
        
        $this->_pdo->exec("create table tbl_frases (
				id			integer  	primary key,
			 	text		text 		not null,
			 	tema_id		integer     references tema(id),
				autor_id	integer		references autor(id));");
        
        $filename=__ROOT__."/assets/frases.xml";
        if (file_exists($filename)) {
            $xml = simplexml_load_file($filename);
        } else {
            throw new Exception("No hi ha fitxer a $filename");
        }
        /*
         $pre1 = $this->_pdo->prepare("insert into tbl_autors values(?,?,?,?);");
         $pre2 = $this->_pdo->prepare("insert into tbl_frases values(?,?,?,?);");
         $pre3 = $this->_pdo->prepare("insert into tbl_temes values(?,?);");
         */
        
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        
        foreach ($xml->autor as $autor) {
            
            //Verifico si hi ha algun autor amb el mateix nom....
            if (($oAutor = $mAutors->getByName($autor->nombre->__toString())) == null) {
                $oAutor = new ON_Author(0, $autor->nombre->__toString(), $autor->descripcion->__toString(), 0, $autor->attributes()["url"]->__toString());
                
                $mAutors->create($oAutor);
                $oAutor = $mAutors->getByName($autor->nombre);
            }
            
            foreach ($autor->frases->frase as $frase) {
                if (($oTema = $mTemes->getByName($frase->tema->__toString()))==null) {
                    $oTema = new ON_Theme(0, $frase->tema->__toString(), 0);
                    $mTemes->create($oTema);
                    $oTema = $mTemes->getByName($frase->tema->__toString());
                }

                $oFrase = new ON_Phrase(0, $frase->texto->__toString(), $oTema, $oAutor);
                $this->create($oFrase);
            }
        }
    }
    
    public function generate2() {
        $this->_pdo->exec("drop database if exists frases;");
        $this->_pdo->exec("create database frases default character set utf8 default collate utf8_general_ci;");
        $this->_pdo->exec("use frases");

        $this->_pdo->exec("create table tbl_autors (
			 	id			integer  	primary key,
                url         varchar(100),
			 	nom    		varchar(50) not null,
			 	descripcio  varchar(200) not null);");

        $this->_pdo->exec("create table tbl_temes (
			 	id			integer  	primary key,
 				nom    		varchar(50) not null);");

        $this->_pdo->exec("create table tbl_frases (
				id			integer  	primary key,
			 	text		text 		not null,
			 	tema_id		integer     references tema(id),
				autor_id	integer		references autor(id));");

        $filename=__ROOT__."/assets/frases.xml";
        if (file_exists($filename)) {
            $xml = simplexml_load_file($filename);
        } else {
            throw new Exception("No hi ha fitxer a $filename");
        }

        $pre1 = $this->_pdo->prepare("insert into tbl_autors values(?,?,?,?);");
        $pre2 = $this->_pdo->prepare("insert into tbl_frases values(?,?,?,?);");
        $pre3 = $this->_pdo->prepare("insert into tbl_temes values(?,?);");

        $idAutor = 1;
        $idFrase = 1;
        $temas = array();

        foreach ($xml->autor as $autor) {
            $params = array(
                $idAutor,
                $autor->attributes()["url"],
                $autor->nombre,
                $autor->descripcion
            );
            $pre1->execute($params);

            foreach ($autor->frases->frase as $frase) {
                $tema = (string) $frase->tema;
                $existe = false;
                for ($i = 0; $i < count($temas); $i ++) {
                    if ($temas[$i] == $tema) {
                        $idTema = $i + 1;
                        $existe = true;
                    }
                }
                if (! $existe) {
                    $idTema = count($temas) + 1;
                    $temas[] = $tema;
                    $pre3->execute(array(
                        $idTema,
                        $tema
                    ));
                }

                $params = array(
                    $idFrase,
                    $frase->texto,
                    $idTema,
                    $idAutor
                );
                $pre2->execute($params);
                $idFrase ++;
            }
            $idAutor ++;
        }
    }
    
    
}


