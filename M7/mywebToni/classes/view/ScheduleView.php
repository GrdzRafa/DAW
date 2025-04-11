<?php

class ScheduleView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($anymes, $esdeveniments=null) {
        include $this->file;
        $menu_actiu = "horari";
        
        //A anymes arriba l'any i el mes (2409) que volem pintar.
        $dia = "01";
        $any = "20".substr($anymes,0,2);
        $mes = substr($anymes,2);
        $dataActual = date('Y-m-d', strtotime("$any-$mes-$dia"));
        
        //Busco el darrer dilluns del mes anterior
        $primerDia = date('Y-m-d', strtotime('last Monday', strtotime($dataActual."- 7 days")));
        $ultimDia = date('Y-m-d', strtotime('second Sunday of next month', strtotime($dataActual)));
        
        $result = array();
        $dataActual = $primerDia;
        do {
            $result[$dataActual]['actiu'] = (date('m',strtotime($dataActual)) == $mes);
            $result[$dataActual]['today'] = ($dataActual == date('Y-m-d'));
            
            $dataActual = date('Y-m-d', strtotime($dataActual.'+ 1 day'));
        } while (date_diff(date_create($ultimDia), date_create($dataActual))->days!=0);
        
        $result[$dataActual]['actiu'] = (date('m',strtotime($dataActual)) == $mes);
        $result[$dataActual]['today'] = ($dataActual == date('Y-m-d'));
        
        
        //Busco els esdeveniments d'un dia.
        foreach($esdeveniments as $esdeveniment) {
            if (is_null($esdeveniment->final)) {
                $dia = substr($esdeveniment->dataInici, 0, 2);
                $mes = substr($esdeveniment->dataInici, 3, 2);
                $any = substr($esdeveniment->dataInici, 6);
                $ymd = date('Y-m-d', strtotime("$any-$mes-$dia"));
                
                $result[$ymd]["simple"] = true;
            } 
        }
        
        //Busco els esdeveniments de més d'un dia.
        foreach($esdeveniments as $esdeveniment) {
            if (!is_null($esdeveniment->final)) {
                $dia = substr($esdeveniment->dataInici, 0, 2);
                $mes = substr($esdeveniment->dataInici, 3, 2);
                $any = substr($esdeveniment->dataInici, 6);
                $ymd = date('Y-m-d', strtotime("$any-$mes-$dia"));
                
                $dia = substr($esdeveniment->final, 0, 2);
                $mes = substr($esdeveniment->final, 3, 2);
                $any = substr($esdeveniment->final, 6);
                $ymdf = date('Y-m-d', strtotime("$any-$mes-$dia"));
                
                $result[$ymd]["start"] = true;
                $dataActual = date($ymd);
                $dataActual = date('Y-m-d', strtotime($dataActual.'+ 1 day'));
                while (date_diff(date_create($ymdf), date_create($dataActual))->days!=0 && date_create($ultimDia)>date_create($dataActual)) {
                    
                    $result[$dataActual]["middle"] = true;
                    $dataActual = date('Y-m-d', strtotime($dataActual.'+ 1 day'));
                }
                if (date_create($ultimDia)>date_create($dataActual)) {
                    $result[$ymdf]["end"] = true;
                }
            }
        }
        
        echo "
            <!DOCTYPE html><html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <title>Thos i Codina - Desenvolupament web en entorn servidor</title>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
                <link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css\">
                <link rel=\"stylesheet\" href=\"../css/style.css?v=1.1\">
                <link rel=\"stylesheet\" href=\"../css/calendar.css?v=1.2\">
            </head>";
        
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<section class=\"contingut\">";
        echo $this->html_generate_header($anymes);
        echo $this->html_generate_body($result);
        echo $this->html_generate_next($esdeveniments);
        echo "</section></main></body></html>";
    }
    
    private function html_generate_header($data) {
        $anyActual = intval(substr($data, 0, 2));
        $mesActual = intval(substr($data, 2, 2));
        if ($mesActual==1) {
            $mesAnterior = 12;
            $anyAnterior = $anyActual-1;
            $mesPosterior = 2;
            $anyPosterior = $anyActual;
        } elseif ($mesActual==12) {
            $mesAnterior = 11;
            $anyAnterior = $anyActual;
            $mesPosterior = 1;
            $anyPosterior = $anyActual+1;
        } else {
            $mesAnterior = $mesActual-1;
            $anyAnterior = $anyActual;
            $mesPosterior = $mesActual+1;
            $anyPosterior = $anyActual;
        }
        $dataActual = $this->html_convertir_data($data);
        $dataAnterior = sprintf("%02d",$anyAnterior).sprintf("%02d",$mesAnterior);
        $dataPosterior = sprintf("%02d",$anyPosterior).sprintf("%02d",$mesPosterior);
        
        $anyAnterior = sprintf("%02d",$anyActual-1) . sprintf("%02d",$mesActual);
        $anyPosterior = sprintf("%02d",$anyActual+1) . sprintf("%02d",$mesActual);
        
        

        $html = 
            "<div class=\"calendar-container__header\">
                <a href=\"?schedule/show/$anyAnterior\">    
                    <button class=\"calendar-container__btn calendar-container__btn--left\" title=\"Previous\">
                        <i class=\"icon ion-ios-arrow-back\"></i>
                    </button>
                </a>
                <a href=\"?schedule/show/$dataAnterior\">    
                    <button class=\"calendar-container__btn calendar-container__btn--left\" title=\"Previous\">
                        <i class=\"icon ion-ios-arrow-left\"></i>
                    </button>
                </a>
                <h2 class=\"calendar-container__title\">$dataActual</h2>
                <a href=\"?schedule/show/$dataPosterior\">
                    <button class=\"calendar-container__btn calendar-container__btn--right\" title=\"Next\">
                        <i class=\"icon ion-ios-arrow-right\"></i>
                    </button>
                </a>
                <a href=\"?schedule/show/$anyPosterior\">    
                    <button class=\"calendar-container__btn calendar-container__btn--left\" title=\"Previous\">
                        <i class=\"icon ion-ios-arrow-forward\"></i>
                    </button>
                </a>
            </div>";
        return $html;
    }
    
    private function html_generate_body($calendari) {
        $html ="
        <div class=\"calendar-container__body\">
			<div class=\"calendar-table\">
				<div class=\"calendar-table__header\">
					<div class=\"calendar-table__row\">
						<div class=\"calendar-table__col\">Dl</div>
						<div class=\"calendar-table__col\">Dm</div>
						<div class=\"calendar-table__col\">Dx</div>
						<div class=\"calendar-table__col\">Dj</div>
						<div class=\"calendar-table__col\">Dv</div>
						<div class=\"calendar-table__col\">Ds</div>
						<div class=\"calendar-table__col\">Dg</div>
					</div>
				</div>
				<div class=\"calendar-table__body\">
					<div class=\"calendar-table__body\">";

        $count = 1;
        foreach ($calendari as $dia => $valors) {
            if ($count%7 == 1) {
                $html .= "<div class=\"calendar-table__row\">";
            }
            $html .= "<div class=\"calendar-table__col";
            $html .= !$valors['actiu'] ? " calendar-table__inactive" : "";
            $html .= isset($valors['simple']) ? " calendar-table__event" : "";
            $html .= isset($valors['start']) ? "  calendar-table__event calendar-table__event--long calendar-table__event--start" : "";
            $html .= isset($valors['middle']) ? "  calendar-table__event calendar-table__event--long" : "";
            $html .= isset($valors['end']) ? "  calendar-table__event calendar-table__event--long calendar-table__event--end" : "";
            $html .= $valors['today'] ? " calendar-table__today" : "";
            $html .= " \">";
            
            
			$html .= "<div class=\"calendar-table__item\"><span>";
			$html .= substr($dia,8,2)."</span></div></div>";
            if ($count%7 == 0) {
                $html .= "</div>";
            }
            $count++;
        }
		$html .= "</div></div></div></div>";
        return $html;
    }
    
    private function html_generate_next($events) {      
        $html = "
            <div class=\"events-container\">
			<span class=\"events__title\">Propers aconteixements aquest mes</span>
			<ul class=\"events__list\">";
        if (!is_null($events)) {
            foreach ($events as $event) {
                $data = $event->dataInici;
                $data .= (isset($event->final)) ? " a ".$event->final :"";
                $hora = (isset($event->horaInici)) ? $event->horaInici : "All day";
            
                $html .= "<li class=\"events__item\">
					<div class=\"events__item--left\">
						<span class=\"events__name\">{$event->titol}</span>
						<span class=\"events__date\">$data</span>
					</div>
					<span class=\"events__tag \">$hora</span></li>";
            }
        } else {
            $html .= "<li class=\"events__item\">
					<div class=\"events__item--left\">
						<span class=\"events__name\">Sense esdeveniments planificats</span>
						
					</div></li>";
        }
        $html .= "</div>";
        return $html;
    }
    
    private function html_convertir_data($data) {
        $mes = array("","Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Desembre");
        $anyActual = substr($data, 0, 2);
        $mesActual = intval(substr($data, 2, 2));
        
        return "{$mes[$mesActual]} 20$anyActual";
    }
    
    public function maintenance($esdeveniments) {
        include $this->file;
        $menu_actiu = "maintenance";
        $id = 6320;
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        //echo "<section class=\"content\">";
        echo "<div class=\"left-content\"><table class=\"schedule\">";
        echo $this->html_genera_tr_capcelera();
        echo $this->html_genera_tr_new();
        
        foreach($esdeveniments as $esdeveniment) {
            echo $this->html_genera_tr($esdeveniment);
        }
        echo "</table>";
        echo $this->html_genera_footer();
        echo "</div></main></body></html>";
    }
    
    public function add($esd=new ON_Esdeveniment()) {
        include $this->file;
        $menu_actiu = "maintenance";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        //echo "<section class=\"content\">";
        echo "<div class=\"left-content\">";
        echo $this->html_genera_form_new($esd);
        if (isset($esd->errorsDetectats["ok"])) {
            echo"<div class=\"activity-three\"><label>Dades enviades correctament.</label></div><br />";
        }
        echo "</div></section></main></body></html>";
    }
    
    private function html_genera_tr_capcelera() {
        return "
        <tr>
            <th>ID</th>
			<th>DATA INICI</th>
			<th>HORA</th>
			<th>DATA FI</th>
            <th>TITOL</th>
            <th>CONTINGUT</th>
			<th>ACCIONS</th>
		</tr>";
    }
    
    private function html_genera_tr_new() {
        return "
        <tr>
			<td colspan='6' style='text-align:right;'>Afegir nou element ...</td>
			<td>
                <a href=\"?schedule/add\">
                    <img src='../images/add-icon.svg' style='width:30px; height:30px;' />
                </a>
			</td>
		</tr>";
    }
    
    private function html_genera_form_new(ON_Esdeveniment $on = new ON_Esdeveniment()) {
        $options = ["type"=>"text",
            "name"=>"dataInici",
            "placeholder"=>"xx/xx/xxxx",
            "class"=>"llarg",
            "value"=> $on->dataInici
        ];
        $dataInici = $this->html_generaInput($options);
        $errorDataInici = isset($on->errorsDetectats["dataInici"]) ? $on->errorsDetectats["dataInici"] : "";
        
        $options = ["type"=>"text",
            "name"=>"horaInici",
            "placeholder"=>"xx:xx",
            "class"=>"llarg",
            "value"=> $on->horaInici];
        $horaInici = $this->html_generaInput($options);
        $errorHoraInici = isset($on->errorsDetectats["horaInici"]) ? $on->errorsDetectats["horaInici"] : "";
        
        $options = ["type"=>"text",
            "name"=>"final",
            "placeholder"=>"xx/xx/xxxx",
            "class"=>"llarg",
            "value"=> $on->final];
        $dataFi = $this->html_generaInput($options);
        $errorDataFinal = isset($on->errorsDetectats["dataFinal"]) ? $on->errorsDetectats["dataFinal"] : "";
        
        $options = ["type"=>"text",
            "name"=>"titol",
            "placeholder"=>"Títol de l'esdeveniment",
            "class"=>"llarg",
            "value"=> $on->titol];
        $titol = $this->html_generaInput($options);
        $errorTitol = isset($on->errorsDetectats["titol"]) ? $on->errorsDetectats["titol"] : "";
        
        $options = ["type"=>"text",
            "name"=>"contingut",
            "placeholder"=>"Descripció de l'esdeveniment",
            "class"=>"llarg",
            "value"=> $on->contingut];
        $contingut = $this->html_generaInput($options);
        $errorContingut = isset($on->errorsDetectats["contingut"]) ? $on->errorsDetectats["contingut"] : "";
        
        return "
        <form class=\"msform\" name=\"new\" method=\"POST\" action=\"\">
            <input type=\"hidden\" name=\"id\" value=\"{$on->id}\" />
            <div>
                <label>Data d'inici: (*)</label>$dataInici
                <span class=\"error\" style=\"display:block;\">$errorDataInici<span>
            </div>
            <div>
                <label>Hora d'inici:</label>$horaInici
                <span class=\"error\" style=\"display:block;\">$errorHoraInici<span>
            </div>
            <div>
                <label>Data de final:</label>$dataFi
                <span class=\"error\" style=\"display:block;\">$errorDataFinal<span>
            </div>
            <div>
                <label>Títol de l'esdeveniment: (*)</label>$titol
                <span class=\"error\" style=\"display:block;\">$errorTitol<span>
            </div>
            <div>
                <label>Descripció:</label>$contingut
                <span class=\"error\" style=\"display:block;\">$errorContingut<span>
            </div>    			
            <button class=\"btn\" style='float:right;'>Grabar</button>
		</tr>
    </form>";
        
    }
    
    private function html_genera_tr(ON_Esdeveniment $on) {
        return "
        <tr>
			<td>{$on->id}</td>
			<td>{$on->dataInici}</td>
			<td>{$on->horaInici}</td>
			<td>{$on->final}</td>
            <td>{$on->titol}</td>
            <td>{$on->contingut}</td>
			<td>
                <a href=\"?schedule/update/{$on->id}\">
				    <img src='../images/edit.svg' style='width:30px; height:30px;' />
                </a>
                <a href=\"?schedule/delete/{$on->id}\">
				    <img src='../images/delete.svg' style='width:30px; height:30px;' />
                </a>
			</td>
		</tr>";
    }
    
    private function html_genera_footer() {
        return "
        <div class='table-footer'>
            <a href=\"?schedule/maintenance/2\">
    			<button class=\"btn\" style='float:right;'>Següent</button>
    		</a>
		</div>";
    }
}
