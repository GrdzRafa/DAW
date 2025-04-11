<?php
class DAO_Authors {
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

    public function create(ON_Author $newAutor)    {
        if (! isset($newAutor)) {
            throw new Exception("Impossible crear autor buit");
        }
        if ($this->getById($newAutor->getId()) != null) {
            throw new Exception("Ja existeix un Autor amb la clau {$newAutor->getId()}");
        }
        //Verifiquem que no hi hagi cap autor igual ja creat.
        $preparedStmt = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_autors WHERE nom LIKE ?");
        $preparedStmt->execute(array($newAutor->getnom()));

        //No hi ha cap registre, puc afegir        
        if ($preparedStmt->fetch()[0]===0) {
            $preparedStmtMax = $this->_pdo->prepare("SELECT MAX(id) FROM tbl_autors");
            $preparedStmtMax->execute(array());
            $registre = $preparedStmtMax->fetch();
            $regSeguent = $registre[0] + 1;
    
            $preparedStmt = $this->_pdo->prepare("INSERT INTO tbl_autors (id, url, nom, descripcio) VALUES (?, ?, ?, ?)");
            $preparedStmt->execute(array(
                $regSeguent,
                $newAutor->geturl(),
                $newAutor->getnom(),
                $newAutor->getdescripcio()
            ));
            if ($preparedStmt->errorCode() != 0) {
                throw new Exception("Impossible crear autor " . $params[0] . "per error " . $preparedStmt->errorInfo());
            }
            return true;
        } else {
            return false;
        }
    }

    public function read($registresPerPagina=null, $offSet=null)    {
        $resultat = array();

        if ($this->count() > 0) {
            if (isset($registresPerPagina) && (isset($offSet))) {
                $preparedStmtAutors = $this->_pdo->prepare("SELECT * FROM tbl_autors ORDER BY nom LIMIT " . $registresPerPagina . " OFFSET " . $offSet);
            } else {
                $preparedStmtAutors = $this->_pdo->prepare("SELECT * FROM tbl_autors ORDER BY nom");
            }
            $preparedStmtAutors->execute();
    
            while ($registre = $preparedStmtAutors->fetch()) {
                $stmtNumeroFrases = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_frases WHERE autor_id=?");
                $stmtNumeroFrases->execute(array(
                    $registre['id']
                ));
    
                $resultat[] = new ON_Author(
                    $registre['id'],
                    $registre['nom'], 
                    $registre['descripcio'], 
                    $stmtNumeroFrases->fetch()[0]);
            }
        }

        return $resultat;
    }
    
    public function update(ON_Author $autorToUpdate) {
        if (! isset($autorToUpdate)) {
            throw new Exception("Impossible actualitzar autor buit");
        }
        if ($this->getById($autorToUpdate->getId()) == null) {
            throw new Exception("No existeix un Autor amb la clau {$autorToUpdate->getId()}");
        }
        $stmtAutor = $this->_pdo->prepare("UPDATE tbl_autors SET nom=?, descripcio=? WHERE id=?");
        $res = $stmtAutor->execute(array(
            $autorToUpdate->getnom(),
            $autorToUpdate->getdescripcio(),
            $autorToUpdate->getId()
        ));
    }

    public function delete(ON_Author $autorToDelete) {
        if (! isset($autorToDelete)) {
            throw new Exception("Impossible esborrar autor buit");
        }
        if ($this->getById($autorToDelete->getId()) == null) {
            throw new Exception("No existeix un Autor amb la clau {$autorToDelete->getId()}");
        }
        $stmtFrases = $this->_pdo->prepare("DELETE FROM tbl_frases WHERE autor_id=?");
        if ($res = $stmtFrases->execute(array(
            $autorToDelete->getId()
        ))) {
            // Hem esborrat les frases i no hi ha hagut error.... podem esborrar l'autor
            $stmtAutor = $this->_pdo->prepare("DELETE FROM tbl_autors WHERE id=?");
            if ($res = $stmtAutor->execute(array(
                $autorToDelete->getId()
            ))) {
                return true;

                /*
                 * //Si ha anat tot be, mostrem el llistat d'autors
                 * $autors = $this->llegirAutors();
                 * $fc_capcelera = $this->traduccions->getFCCapcelera();
                 * $taulaHtml = $this->generaTaulaHtml($autors, $fc_capcelera);
                 * parent::show($taulaHtml, "AutorController", "show");
                 */
            } else {
                throw new Exception("Problemes a l'esborrar l'autor $idAutor" . $stmtAutor->errorCode(), "AutorController linia 47 ");
            }
        } else {
            throw new Exception("Problemes a l'esborrar les frases de l'autor $idAutor" . $stmtFrases->errorCode(), "AutorController linia 50 ");
        }
    }

    public function count() {
        try {
            $stmtNumeroAutors = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_autors");
            $stmtNumeroAutors->execute(array());
            $result=$stmtNumeroAutors->fetch()[0];
        } catch (PDOException $e) {
            $result=0;
        }
        return $result;
    }

    public function getById($id)    {
        if (! isset($id)) {
            throw new Exception("AutorsModel->getById sense id");
        }
        $preparedStmtAutors = $this->_pdo->prepare("SELECT * FROM tbl_autors WHERE id=?");
        $preparedStmtAutors->execute(array(
            $id
        ));

        if ($registre = $preparedStmtAutors->fetch()) {
            $stmtNumeroFrases = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_frases WHERE autor_id=?");
            $stmtNumeroFrases->execute(array(
                $id
            ));
            $result = new ON_Author($registre['id'], $registre['nom'], $registre['descripcio'], $stmtNumeroFrases->fetch()[0]);
        } else {
            $result=null;
        }
        return $result;
    }
    
    public function getByName($name)    {
        if (! isset($name)) {
            throw new Exception("AutorsModel->getByName sense nom");
        }
        
        $preparedStmtAutors = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_autors WHERE nom LIKE ?");
        $preparedStmtAutors->execute(array(
            $name
        ));
        if ($preparedStmtAutors->fetch()[0]===0) {
            return null;
        }
        
        $preparedStmtAutors = $this->_pdo->prepare("SELECT * FROM tbl_autors WHERE nom LIKE ?");
        $preparedStmtAutors->execute(array(
            $name
        ));
        
        if ($registre = $preparedStmtAutors->fetch()) {
            $stmtNumeroFrases = $this->_pdo->prepare("SELECT COUNT(*) FROM tbl_frases WHERE autor_id=?");
            $stmtNumeroFrases->execute(array(
                $registre["id"]
            ));
            $result = new ON_Author($registre['id'], $registre['nom'], $registre['descripcio'], $stmtNumeroFrases->fetch()[0]);
        } else {
            $result=null;
        }
        return $result;
    }
}


