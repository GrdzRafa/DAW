<?php
class ThemesController extends Celebres{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($params) {
        $pagina = (isset($params[0])) ? $params[0] : 1;
        $offset = ($pagina-1)*$this->registresPerPagina;
        
        $model = new DAO_Themes();
        $paginaMaxima = ceil($model->count()/$this->registresPerPagina);
        $on = $model->read($this->registresPerPagina,$offset);
        
        $vista = new ThemesView();
        $vista->show($on, $paginaMaxima, $pagina);
    }
    
    public function form_add($param) {
        
        if (isset($param['button1_x'])) {
            $nom = $this->sanitize($param['nom']);
            if (strlen($nom)==0) {
                $errorsDetectats['nom'] = "Dada obligatòria";
            } elseif(!$this->validateItem($nom,"nom")) {
                $nom = "";
                $errorsDetectats['nom'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            
            $tema = new ON_Theme(0,$nom);
            
            if (!isset($errorsDetectats)) {
                $mTemes = new DAO_Themes();
                $mTemes->create($tema);
                $this->show($param);
            } else {
                $vTemes = new ThemesView();
                $vTemes->form($tema, $errorsDetectats);
            }
        } else {
            $this->show($param);
        }
    }
    
    public function add($params) {
        $vTemes = new ThemesView();
        $vTemes->form();
    }
    
    public function delete($params) {
        if (!isset($params[0])) {
            throw new Exception("No es pot eliminar sense registre");
        }
        $mTemes = new DAO_Themes();
        if (($obj=$mTemes->getById($params[0]))==null) {
            throw new Exception("No es pot eliminar un registre que no existeix");
        }
        
        $mTemes->delete($obj);
        $this->show(array(1));
    }
    
    public function edit($params) {
        $mTemes = new DAO_Themes();
        if (!isset($params[0])) {
            throw new Exception("No puc editar sense referencia al tema");
        }
        if (($tema = $mTemes->getById($params[0]))==null) {
            throw new Exception("No puc resuperar el tema a modificar");
        }
        
        $vTemes = new ThemesView();
        $vTemes->form($tema);
    }
    
    public function form_edit($param) {
        if (!isset($param['id'])) {
            throw new Exception("No puc editar sense referencia al tema");
        }
        $mTemes = new DAO_Themes();
        if (($tema=$mTemes->getById($param['id']))==null) {
            throw new Exception("No es pot actualitzar un registre que no existeix");
        }
        
        if (isset($param['button1_x'])) {
            $id = $this->sanitize($param['id']);
            $nom = $this->sanitize($param['nom']);
            if (strlen($nom)==0) {
                $errorsDetectats['nom'] = "El tema és obligatori";
            } else if (!$this->validateItem($nom,"alfanum")) {
                $errorsDetectats['nom'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            
            $tema = new ON_Theme($id,$nom);
            
            if (!isset($errorsDetectats)) {
                $mTemes->update($tema);
                $this->show(array(1));
            } else {
                $vTemes = new ThemesView();
                $vTemes->form($tema, $errorsDetectats);
            }
        } else {
            $this->show($param);
        }
    }
}
?>