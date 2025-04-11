<?php

class MaintenanceView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        include $this->file;
        $menu_actiu = "maintenance";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<section class=\"content\">";
        echo "
        <div class=\"left-content\">
			<div class=\"activities\">
				<h1>Manteniments</h1>
				<div class=\"left-bottom\">
					<div class=\"weekly-schedule\">
						<div class=\"calendar\">
							<div class=\"day-and-activity activity-one\">
								<div class=\"day\">
									<h1>1</h1>
								</div>
								<div class=\"activity\">
									<h2>Calendari</h2>
								</div>
								<a href=\"?schedule/maintenance\">
									<button class=\"btn\">Accedir</button>
								</a>
							</div>
						</div>
					</div>
				</div>
                <div class=\"left-bottom\">
					<div class=\"weekly-schedule\">
						<div class=\"calendar\">
							<div class=\"day-and-activity activity-two\">
								<div class=\"day\">
									<h1>2</h1>
								</div>
								<div class=\"activity\">
									<h2>Freses cèlebres</h2>
								</div>
								<a href=\"?phrases/show\">
									<button class=\"btn\">Accedir</button>
								</a>
							</div>
						</div>
					</div>


				</div>
			</div>
        ";
        echo "</section></main></body></html>";
    }
}

