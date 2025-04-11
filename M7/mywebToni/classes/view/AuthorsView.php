<?php

class AuthorsView extends View {

    public function __construct() {
        parent::__construct();
    }

    public function show($on, $paginaMaxima, $pagina=1) {
        include $this->file;
        $menu_actiu = "maintenance";

        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<div class=\"left-content\">";
        echo $this->capcelera();
        echo "<table>";
        echo $this->thead();
        echo $this->genera_primer_tr();
        echo $this->genera_trs($on); 
        echo "</table>";
        echo $this->peu($pagina, $paginaMaxima);
        echo "</div></main></body></html>";
    }
    
    public function form($on=null, $error=null) {
        include $this->file;
        $menu_actiu = "maintenance";
        
        if ($on instanceof ON_Author) {
            $id=$on->getId();
            $nom=$on->getNom();
            $descripcio=$on->getDescripcio();
        } else {
            $id="";
            $nom="";
            $descripcio="";
        }
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<div class=\"left-content\">";
        echo $this->capcelera();
        echo "<form action='' method='post'><table>";
        echo $this->thead();
        echo "
        <tr><input type='hidden' name='id' value='$id'></tr><tr></tr>
        <tr>
        <td style='width:25%;'>
            <input type='text' name='nom' style='width:95%;' value='$nom'>
        </td>
        <td style='width:50%;'>
            <input type='text' name='descripcio' style='width:95%;' value='$descripcio'>
        </td>
        <td style='width:10%;'></td>
        <td style='width:15%;'>
            <input name='button1' type='image' src='../images/send.png' style='width:40%; margin:5px'>
            <input name='button2' type='image' src='../images/delete.svg' style='width:40%; margin:5px'>
        </td>
        </tr>
        <tr>
        <td style='width:25%; color:red; background-color:rgb(214, 227, 248)'>
            {$error['nom']}
        </td>
        <td style='width:50%; color:red; background-color:rgb(214, 227, 248)'>
            {$error['descripcio']}
        </td>
        <td style='width:10%; background-color:rgb(214, 227, 248)'></td>
        <td style='width:15%; background-color:rgb(214, 227, 248)'>
        </td>
        </tr>
        <tr></tr><tr></tr>";
            
            echo "</table></form>";
            echo "<div class='table-footer'></div>";
            //echo $this->peu($pagina, $paginaMaxima, $restriccio);
            echo "</div></main></body></html>";
    }
    
    

    public function capcelera() {
        return "<div class='table-footer'>
    			<a href=\"?phrases/show/1\" style='float:left; width:25%;'>
    				<button class=\"btn\">Veure Frases</button>
    			</a>
                <a href=\"?authors/show/1\" style='float:left; width:25%;'>
    				<button class=\"btn\">Veure Autors</button>
    			</a>
                <a href=\"?themes/show/1\" style='float:left; width:25%;'>
    				<button class=\"btn\">Veure Temes</button>
    			</a>
                <a href=\"?phrases/load\" style='float:left; width:25%;'>
    				<button class=\"btn\">Carregar xml</button>
    			</a></div>";
    }

    public function peu($pagina, $paginaMaxima) {
        $first = 1;
        $previous = ($pagina==1) ? 1 : $pagina-1;
        $next = ($pagina==$paginaMaxima) ? $paginaMaxima : $pagina+1;
        $last = $paginaMaxima;
        
        return "
        <div class='table-footer'>
    		<a href=\"?authors/show/$first\">
    			<button class=\"btn\" style='float:left;'><<  Primera</button>
    		</a>
    		<a href=\"?authors/show/$previous\">
    			<button class=\"btn\" style='float:left;'><  Anterior</button>
    		</a>
    		<a>
    			<button class=\"btn\" style='float:left;'>Pàgina num. $pagina</button>
    		</a>
            <a href=\"?authors/show/$last\">
    			<button class=\"btn\" style='float:right;'>Última  >></button>
    		</a>
    		<a href=\"?authors/show/$next\">
    			<button class=\"btn\" style='float:right;'>Següent  ></button>
    		</a>
    		

        </div>";
    }
    
    public function thead() {
        return "<tr>
					<th>Autor</th>
					<th>Descripcio</th>
					<th>Num de frases</th>
					<th>Acció</th>
				</tr>";
    }
    
    public function genera_primer_tr() {
        return "<tr>
					<td colspan='3' style='text-align:right;'>Afegir nou element ...</td>
					<td>
                        <a href='?authors/add'>
						  <img src='../images/edit.svg' style='width:30px; height:30px;' />
                        </a>
					</td>
				</tr>";
    }
    
    public function genera_trs($on) {
        $html="";
        foreach ($on as $autor) {
            $id=$autor->getId();
            $url=$autor->getUrl() ;
            $nom=$autor->getNom();
            $descripcio=$autor->getDescripcio();
            $numero=$autor->getNumeroDeFrases();
            
            $html .= "<tr>
                    <td style='width:25%;'>
                        <a href='?phrases/author/$id'>$nom</a>
                    </td>
					<td style='width:45%;'>$descripcio</td>
                    <td style='text-align:center; width:15%;'>$numero</td>
					<td style='text-align:center; width:15%;'>
                        <a href='?authors/edit/$id'>
						  <img src='../images/edit.svg' style='width:30px; height:30px;' />
                        </a>
                        <a href='?authors/delete/$id'>
						  <img src='../images/delete.svg' style='width:30px; height:30px;' />
                        </a>
					</td>
				</tr>";
        }
        return $html;
    }
}

