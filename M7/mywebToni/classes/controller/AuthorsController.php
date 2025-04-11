<?php
class AuthorsController extends Celebres{
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($params) {
        $pagina = (isset($params[0])) ? $params[0] : 1;
        $offset = ($pagina-1)*$this->registresPerPagina;
        
        $model = new DAO_Authors();
        $paginaMaxima = ceil($model->count()/$this->registresPerPagina);
        $on = $model->read($this->registresPerPagina,$offset);
        
        $vista = new AuthorsView();
        $vista->show($on, $paginaMaxima, $pagina);
    }
    
    public function form_add($param) {
        
        if (isset($param['button1_x'])) {
            $nom = $this->sanitize($param['nom']);
            if (strlen($nom)==0) {
                $errorsDetectats['nom'] = "Dada obligatòria";
            } elseif (!$this->validateItem($nom,"alfanum")) {
                $nom = "";
                $errorsDetectats['nom'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            $descripcio = $this->sanitize($param['descripcio']);
            if (!$this->validateItem($descripcio,"anything")) {
                $descripcio = "";
                $errorsDetectats['descripcio'] = "Descripció invàlida o amb caràcters incorrectes.";
            }

            $autor = new ON_Author(0,$nom, $descripcio);
                        
            if (!isset($errorsDetectats)) {
                $mAutors = new DAO_Authors();
                $mAutors->create($autor);
                $this->show($param);                
            } else {
                $vAutors = new AuthorsView();
                $vAutors->form($autor, $errorsDetectats);
            }
        } else {
            $this->show($param);
        }
    }
    
    public function add($params) {
        $vAutors = new AuthorsView();
        $vAutors->form();
    }
    
    public function delete($params) {
        if (!isset($params[0])) {
            throw new Exception("No es pot eliminar sense registre");
        }
        $mAutors = new DAO_Authors();
        if (($obj=$mAutors->getById($params[0]))==null) {
            throw new Exception("No es pot eliminar un registre que no existeix");
        }
        
        $mAutors->delete($obj);
        $this->show(array(1));
    }
    
    public function edit($params) {
        $mAutors = new DAO_Authors();
        if (!isset($params[0])) {
            throw new Exception("No puc editar sense referencia a l'autor");
        }
        if (($autor = $mAutors->getById($params[0]))==null) {
            throw new Exception("No puc resuperar l'autor a modificar");
        }        
        
        $vAutors = new AuthorsView();
        $vAutors->form($autor);
    }
    
    public function form_edit($param) {
        if (!isset($param['id'])) {
            throw new Exception("No puc editar sense referencia a l'autor");
        }
        $mAutors = new DAO_Authors();
        if (($autor=$mAutors->getById($param['id']))==null) {
            throw new Exception("No es pot actualitzar un registre que no existeix");
        }
        
        if (isset($param['button1_x'])) {
            $id = $this->sanitize($param['id']);
            $nom = $this->sanitize($param['nom']);
            if (strlen($nom)==0) {
                $errorsDetectats['nom'] = "El nom és obligatori";
            } else if (!$this->validateItem($nom,"anything")) {             
                $nom = "";
                $errorsDetectats['nom'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            $descripcio = $this->sanitize($param['descripcio']);
            if (strlen($descripcio)>0 && !$this->validateItem($descripcio,"anything")) {
                $descripcio = "";
                $errorsDetectats['descripcio'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            
            $frase = new ON_Author($id,$nom, $descripcio);
            
            if (!isset($errorsDetectats)) {
                $mAutors->update($frase);
                $this->show(array(1));
            } else {
                $vAutors = new AuthorsView();
                $vAutors->form($autor, $errorsDetectats);
            }
        } else {
            $this->show($param);
        }
    }

}
?>