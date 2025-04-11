<?php
class DAO_Themes {
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

    public function create(ON_Theme $newTema)    {
        if (! isset($newTema)) {
            throw new Exception("Impossible crear autor buit");
        }
        if ($this->getById($newTema->getId()) != null) {
            throw new Exception("Ja existeix un Tema amb la clau {$newTema->getId()}");
        }
        
        //Verifiquem que no hi hagi cap autor igual ja creat.
        $preparedStmt = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_temes WHERE nom LIKE ?");
        $preparedStmt->execute(array($newTema->getnom()));
        
        //No hi ha cap registre, puc afegir
        if ($preparedStmt->fetch()[0]===0) {
            $preparedStmtMax = $this->_pdo->prepare("SELECT MAX(id) FROM tbl_temes");
            $preparedStmtMax->execute(array());
            $registre = $preparedStmtMax->fetch();
            $regSeguent = $registre[0] + 1;
    
            $preparedStmt = $this->_pdo->prepare("INSERT INTO tbl_temes (id, nom) VALUES (?, ?)");
            $preparedStmt->execute(array(
                $regSeguent,
                $newTema->getnom()
            ));
            if ($preparedStmt->errorCode() != 0) {
                throw new Exception("Impossible crear tema " . $params[0] . "per error " . $preparedStmt->errorInfo());
            }
            return true;
        } else {
            return false;
        }
    }

    public function read($registresPerPagina=null, $offSet=null)    {
        $resultat = array();

        if ($this->count() >0) {
            if ((isset($registresPerPagina))&& (isset($offSet))) {
                $preparedStmtTemes = $this->_pdo->prepare("SELECT * FROM tbl_temes ORDER BY nom LIMIT " . $registresPerPagina . " OFFSET " . $offSet);
            } else {
                $preparedStmtTemes = $this->_pdo->prepare("SELECT * FROM tbl_temes ORDER BY nom");
            }
            $preparedStmtTemes->execute();
    
            while ($registre = $preparedStmtTemes->fetch()) {
                $stmtNumeroFrases = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_frases WHERE tema_id=?");
                $stmtNumeroFrases->execute(array(
                    $registre['id']
                ));
    
                $resultat[] = new ON_Theme(
                    $registre['id'],
                    $registre['nom'], 
                    $stmtNumeroFrases->fetch()[0]);
            }
        }

        return $resultat;
    }
    
    public function update(ON_Theme $temaToUpdate) {
        if (! isset($temaToUpdate)) {
            throw new Exception("Impossible actualitzar autor buit");
        }
        if ($this->getById($temaToUpdate->getId()) == null) {
            throw new Exception("No existeix un Tema amb la clau {$temaToUpdate->getId()}");
        }
        $stmtTemes = $this->_pdo->prepare("UPDATE tbl_temes SET nom=? WHERE id=?");
        $res = $stmtTemes->execute(array(
            $temaToUpdate->getnom(),
            $temaToUpdate->getId()
        ));
    }

    public function delete(ON_Theme $temaToDelete) {
        if (! isset($temaToDelete)) {
            throw new Exception("Impossible esborrar tema buit");
        }
        if ($this->getById($temaToDelete->getId()) == null) {
            throw new Exception("No existeix un Tema amb la clau {$temaToDelete->getId()}");
        }
        $stmtFrases = $this->_pdo->prepare("DELETE FROM tbl_frases WHERE tema_id=?");
        if ($res = $stmtFrases->execute(array(
            $temaToDelete->getId()
        ))) {
            // Hem esborrat les frases i no hi ha hagut error.... podem esborrar el tema
            $stmtTema = $this->_pdo->prepare("DELETE FROM tbl_temes WHERE id=?");
            if ($res = $stmtTema->execute(array(
                $temaToDelete->getId()
            ))) {
                return true;

                
            } else {
                throw new Exception("Problemes a l'esborrar el tema $idTema" . $stmtTema->errorCode(), "TemaController linia 47 ");
            }
        } else {
            throw new Exception("Problemes a l'esborrar les frases de el tema $idTema" . $stmtFrases->errorCode(), "TemaController linia 50 ");
        }
    }

    public function count() {
        try {
            $stmtNumeroTemes = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_temes");
            $stmtNumeroTemes->execute(array());
            $result=$stmtNumeroTemes->fetch()[0];
        } catch (PDOException $e) {
            $result=0;
        }
        return $result;
    }

    public function getById($id)    {
        if (! isset($id)) {
            throw new Exception("TemesModel->getById sense id");
        }
        $preparedStmtTemes = $this->_pdo->prepare("SELECT * FROM tbl_temes WHERE id=?");
        $preparedStmtTemes->execute(array(
            $id
        ));

        if ($registre = $preparedStmtTemes->fetch()) {
            $stmtNumeroFrases = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_frases WHERE tema_id=?");
            $stmtNumeroFrases->execute(array(
                $id
            ));
            $result = new ON_Theme($registre['id'], $registre['nom'], $stmtNumeroFrases->fetch()[0]);
        } else {
            $result=null;
        }
        return $result;
    }
    
    public function getByName($name)    {
        if (! isset($name)) {
            throw new Exception("TemesModel->getByName sense nom");
        }
        
        $preparedStmtTemes = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_temes WHERE nom LIKE ?");
        $preparedStmtTemes->execute(array(
            $name
        ));
        if ($preparedStmtTemes->fetch()[0]===0) {
            return null;
        }
        
        $preparedStmtTemes = $this->_pdo->prepare("SELECT * FROM tbl_temes WHERE nom LIKE ?");
        $preparedStmtTemes->execute(array(
            $name
        ));
        
        if ($registre = $preparedStmtTemes->fetch()) {
            $stmtNumeroFrases = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_frases WHERE autor_id=?");
            $stmtNumeroFrases->execute(array(
                $registre["id"]
            ));
            $result = new ON_Theme($registre['id'], $registre['nom'], $stmtNumeroFrases->fetch()[0]);
        } else {
            $result=null;
        }
        return $result;
    }
    
}


