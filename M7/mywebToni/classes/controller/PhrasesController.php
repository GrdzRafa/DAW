<?php
class PhrasesController extends Celebres {

    public function __construct() {
        parent::__construct();
        
        $model = new DAO_Phrases();
        try {
            $frases = $model->read(10,10);
        } catch (PDOException $e) {
            $model->generate2();
        }
    }
    
    public function show($params) {
        $pagina = (isset($params[0])) ? $params[0] : 1;
        $offset = ($pagina-1)*$this->registresPerPagina;
        
        $model = new DAO_Phrases();
        $paginaMaxima = ceil($model->count()/$this->registresPerPagina);
        $frases = $model->read($this->registresPerPagina,$offset);

        $vPhrase = new PhrasesView();
        $vPhrase->show($frases, $paginaMaxima, $pagina);
    }
    
    public function author($params) {
        if (!isset($params) || !isset($params[0])) {
            throw new Exception("crida a phrases/author sense codi de autor");
        } else {
            $autor_id = $params[0];
            $model = new DAO_Authors();
            $autor = $model->getById($autor_id);
        
            $pagina = (isset($params[1])) ? $params[1] : 1;
            $offset = ($pagina-1)*$this->registresPerPagina;
        
            $model = new DAO_Phrases();
            $paginaMaxima = ceil($model->count(array("autor"=>$autor_id))/$this->registresPerPagina);
            $frases = $model->readByAutor($autor,$this->registresPerPagina,$offset);
        
            $vPhrase = new PhrasesView();
            $vPhrase->show($frases, $paginaMaxima, $pagina, "author/$autor_id");
        }
    }

    public function theme($params) {
        if (!isset($params) || !isset($params[0])) {
            throw new Exception("crida a phrases/theme sense codi de tema");
        } else {
            $tema_id = $params[0];
            $model = new DAO_Themes();
            $tema = $model->getById($tema_id);
            
            $pagina = (isset($params[1])) ? $params[1] : 1;
            $offset = ($pagina-1)*$this->registresPerPagina;
            
            $model = new DAO_Phrases();
            $paginaMaxima = ceil($model->count(array("tema"=>$tema_id))/$this->registresPerPagina);
            $frases = $model->readByTema($tema,$this->registresPerPagina,$offset);
            
            $vPhrase = new PhrasesView();
            $vPhrase->show($frases, $paginaMaxima, $pagina, "theme/$tema_id");
        }
    }
    
    public function form_add($param) {
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        
        if (isset($param['button1_x'])) {
            $text = $this->sanitize($param['frase']);
            if (!$this->validateItem($text,"anything")) {
                $text = "";
                $errorsDetectats['text'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            $autor = $this->sanitize($param['autor']);
            if (($autor=$mAutors->getById($autor)) == null) {
                $autor = "";
                $errorsDetectats['autor'] = "Autor incorrecte o no reconeixible";
            }
            $tema = $this->sanitize($param['tema']);
            if (($tema=$mTemes->getById($tema)) == null) {
                $tema = "";
                $errorsDetectats['tema'] = "Tema incorrecte o no reconeixible";
            }        
            
            $frase = new ON_Phrase(0,$text, $tema, $autor);
            
            if (!isset($errorsDetectats)) {
                $mFrases = new DAO_Phrases();
                $mFrases->create($frase);
                $this->show($param);
                
            } else {
                $vFrases = new PhrasesView();
                $vFrases->form($mAutors->read(), $mTemes->read(), $frase, $errorsDetectats);
            }
        } else {
            $this->show($param);
        }
    }
    
    public function add($params) {
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
       
        $vFrases = new PhrasesView();
        $vFrases->form($mAutors->read(), $mTemes->read());
    }
    
    public function delete($params) {
        if (!isset($params[0])) {
            throw new Exception("No es pot eliminar sense registre");
        }
        $mFrases = new DAO_Phrases();
        if (($obj=$mFrases->getById($params[0]))==null) {
            throw new Exception("No es pot eliminar un registre que no existeix");
        }
        
        $mFrases->delete($obj);        
        $this->show(array(1));
    }
    
    public function edit($params) {
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        $mFrases = new DAO_Phrases();
        
        $vFrases = new PhrasesView();
        $vFrases->form($mAutors->read(), $mTemes->read(), $mFrases->getById($params[0]));
    }
    
    public function form_edit($param) {
        $mAutors = new DAO_Authors();
        $mTemes = new DAO_Themes();
        $mFrases = new DAO_Phrases();
        
        if (($frase=$mFrases->getById($param['id']))==null) {
            throw new Exception("No es pot actualitzar un registre que no existeix");
        }

        if (isset($param['button1_x'])) {
            $id = $this->sanitize($param['id']);
            $text = $this->sanitize($param['frase']);
            if (!$this->validateItem($text,"anything")) {
                $text = "";
                $errorsDetectats['text'] = "Dada no vàlida. Hi ha caràcters no reconeguts";
            }
            $autor = $this->sanitize($param['autor']);
            if (($autor=$mAutors->getById($autor)) == null) {
                $autor = "";
                $errorsDetectats['autor'] = "Autor incorrecte o no reconeixible";
            }
            $tema = $this->sanitize($param['tema']);
            if (($tema=$mTemes->getById($tema)) == null) {
                $tema = "";
                $errorsDetectats['tema'] = "Tema incorrecte o no reconeixible";
            }
            
            $frase = new ON_Phrase($id,$text, $tema, $autor);
            
            if (!isset($errorsDetectats)) {
                $mFrases = new DAO_Phrases();
                $mFrases->update($frase);
                $this->show(array(1));                
            } else {
                $vFrases = new PhrasesView();
                $vFrases->form($mAutors->read(), $mTemes->read(), $frase, $errorsDetectats);
            }
        } else {
            $this->show($param);
        }
    }
    
    public function load() {
        $mFrases = new DAO_Phrases();
        $mFrases->generate();
        
        $this->show(array());
    }
}

