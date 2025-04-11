<?php

class ScheduleController extends Controller{
    private $esdeveniments;

    public function __construct() {     
    }
    
    public function show($params=null) {
        
        if ($params==null || count($params)==0) {
            $dt = new DateTime();
            $dt->modify("first day of this month");
            $dataActual = $dt->format('Y-m-d');
            $params[0] = substr($dataActual,2,2) . substr($dataActual,5,2);
        } else {
            $dia = "01";
            $any = "20".substr($params[0],0,2);
            $mes = substr($params[0],2);
            $dataActual = date('Y-m-d', strtotime("$any-$mes-$dia"));
        }
        
        //Busco el darrer dilluns del mes anterior
        $primerDia = date('Y-m-d', strtotime('last Monday', strtotime($dataActual."- 7 days")));
        $ultimDia = date('Y-m-d', strtotime('second Sunday of next month', strtotime($dataActual)));
        

        $model = new DAO_Esdeveniment();
        $esdeveniments = $model->getBetweenDates($primerDia, $ultimDia);
        
        $vPage = new ScheduleView();
        $vPage->show($params[0], $esdeveniments);
    }
    
    public function maintenance($params) {
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
            exit;
        }
        $model = new DAO_Esdeveniment();
        
        $vPage = new ScheduleView();
        $vPage->maintenance($model->getAll());
    }
    
    public function add($params) {
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
            exit;
        }
        if (is_array($params)) {
            $params = new ON_Esdeveniment();
        }
        $vPage = new ScheduleView();
        $vPage->add($params);
    }
    
    public function delete($params) {
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
            exit;
        }
        $model = new DAO_Esdeveniment();
        $model->delete($this->sanitize($params[0]));
        
        $this->maintenance($params);
    }
    
    public function update($params) {
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
            exit;
        }
        $model = new DAO_Esdeveniment();
        $this->add($model->getOneById($this->sanitize($params[0])));
    }
    
    public function form_update($params) {
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
            exit;
        }
        $esd = new ON_Esdeveniment();
        foreach ($params as $key => $value) {
            if (property_exists($esd, $key)) {
                $esd->$key=$this->sanitize($value);
            }
        }
        
        if ($esd->dataInici!="") {
            $dia = intval(substr($esd->dataInici,0,2));
            $mes = intval(substr($esd->dataInici,3,2));
            $any = intval(substr($esd->dataInici,6));
            if (!checkdate($mes,$dia,$any)) {
                $errorsDetectats["dataInici"]="La data d'inici no té un format correcte (dd/mm/aaaa)";
            }
        } else {
            $errorsDetectats["dataInici"]="La data d'inici és un camp obligatori";
        }
        
        if ($esd->horaInici!="") {
            $hora = intval(substr($esd->horaInici,0,2));
            $minuts = intval(substr($esd->horaInici, 3));
            if ($hora<0 || $hora>23 || $minuts<0 || $minuts>59) {
                $errorsDetectats["horaInici"]="L'hora no té un format correcte (hh:mm)";
            }
        }
        
        if ($esd->final!="") {
            $diaf = intval(substr($esd->final,0,2));
            $mesf = intval(substr($esd->final,3,2));
            $anyf = intval(substr($esd->final,6));
            if (checkdate($mesf,$diaf,$anyf)) {
                if (($anyf<$any) || ($anyf==$any && $mesf<$mes) || ($anyf==$any && $mesf==$mes && $diaf<$dia)) {
                    $errorsDetectats["dataFinal"]="La data final és enterior a la inicial";
                }
            } else {
                $errorsDetectats["dataFinal"]="La data no té un format correcte (dd/mm/aaaa)";
            }
        }
        if ($esd->titol=="") {
            $errorsDetectats["titol"]="El títol de l'esdeveniment és un camp obligatori";
        }

        $vPage = new ScheduleView();
        if (isset($errorsDetectats)) {
            $esd->errorsDetectats= $errorsDetectats;
            $vPage->add($esd);
        } else {
            $model = new DAO_Esdeveniment();
            $model->update($esd);
            
            $vPage->maintenance($model->getAll());
        }
    }
    
    public function form_add($params) {
        if (!isset($_SESSION["user"])) {
            header("location:index.php");
            exit;
        }
        $esd = new ON_Esdeveniment();
        foreach ($params as $key => $value) {
            if (property_exists($esd, $key)) {
                $esd->$key=$this->sanitize($value);
            }
        }
        
        if ($esd->dataInici!="") {
            $dia = intval(substr($esd->dataInici,0,2));
            $mes = intval(substr($esd->dataInici,3,2));
            $any = intval(substr($esd->dataInici,6));
            if (!checkdate($mes,$dia,$any)) {
                $errorsDetectats["dataInici"]="La data d'inici no té un format correcte (dd/mm/aaaa)";
            }
        } else {
            $errorsDetectats["dataInici"]="La data d'inici és un camp obligatori";
        }
        
        if ($esd->horaInici!="") {
            $hora = intval(substr($esd->horaInici,0,2));
            $minuts = intval(substr($esd->horaInici, 3));
            if ($hora<0 || $hora>23 || $minuts<0 || $minuts>59) {
                $errorsDetectats["horaInici"]="L'hora no té un format correcte (hh:mm)";
            }
        }
        
        if ($esd->final!="") {
            $diaf = intval(substr($esd->final,0,2));
            $mesf = intval(substr($esd->final,3,2));
            $anyf = intval(substr($esd->final,6));                        
            if (checkdate($mesf,$diaf,$anyf)) {
                if (($anyf<$any) || ($anyf==$any && $mesf<$mes) || ($anyf==$any && $mesf==$mes && $diaf<$dia)) {
                    $errorsDetectats["dataFinal"]="La data final és enterior a la inicial";
                }
            } else {
                $errorsDetectats["dataFinal"]="La data no té un format correcte (dd/mm/aaaa)";
            }
        }
        if ($esd->titol=="") {
            $errorsDetectats["titol"]="El títol de l'esdeveniment és un camp obligatori";
        }
        
        $vPage = new ScheduleView();
        if (isset($errorsDetectats)) {
            $esd->errorsDetectats= $errorsDetectats;
            $vPage->add($esd);
        } else {
            $model = new DAO_Esdeveniment();
            $model->create($esd);
            
            $vPage->maintenance($model->getAll());
        }
        
    }
    
    function convertir_weekday(int $numero) {
        $nomDelsDies = array('Diumenge', 'Dilluns', 'Dimarts', 'Dimeches', 'Dijous', 'Divendres', 'Dissapte');
        return $nomDelsDies[$numero];
    }
    
 
    function convertir_mes(int $numero) {
        $nomDelsMesos=array('','Gener','Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');
        return $nomDelsMesos[$numero];
    }
}

