<?php

class PhrasesView extends View {

    public function __construct()  {
        parent::__construct();
    }

    public function show($on, $paginaMaxima, $pagina=1, $restriccio=null) {
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
        echo $this->peu($pagina, $paginaMaxima, $restriccio);
        echo "</div></main></body></html>";
    }
    
    public function form($autors, $temes, $on=null, $error=null) {
        include $this->file;
        $menu_actiu = "maintenance";
        
        if ($on instanceof ON_Phrase) {
            $id=$on->getId();
            $text=$on->getText();
            $autor=$on->getAutor()->getId();
            $tema=$on->getTema()->getId();
        } else {
            $id="";
            $text="";
            $autor="";
            $tema="";
        }
        
        $autor_options=$this->html_autor_options($autors, $autor);
        $tema_options=$this->html_tema_options($temes, $tema);
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo "<body><main>";
        include "../inc/main-menu.php";
        echo "<div class=\"left-content\">";
        echo $this->capcelera();
        echo "<form action='' method='post'><table>";
        echo $this->thead();
        echo "
        <tr></tr><tr><input type='hidden' name='id' value='$id'></tr>
        <tr>
        <td style='width:55%;'>
            <input type='text' id='frase' name='frase' style='width:95%;' value='$text'>
        </td>
        <td style='text-align:center; width:20%;'>
            <select style='width:90%;' name='autor' >$autor_options</select>
        </td>
        <td style='text-align:center; width:15%;'>
            <select style='width:90%;' name='tema' >$tema_options</select>
        </td>
        <td style='width:10%; class:pijama;'>
            <input name='button1' type='image' src='../images/send.png' style='width:40%; margin:5px'>
            <input name='button2' type='image' src='../images/delete.svg' style='width:40%; margin:5px'>
        </td>
        </tr>
        <tr>
        <td style='width:55%; color:red; background-color:rgb(214, 227, 248)'>
            {$error['text']}
        </td>
        <td style='width:20%; color:red; background-color:rgb(214, 227, 248)'>
            {$error['autor']}
        </td>
        <td style='width:15%; color:red; background-color:rgb(214, 227, 248)'>
            {$error['tema']}
        </td>
        <td style='width:10%; background-color:rgb(214, 227, 248)'>
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

    public function peu($pagina, $paginaMaxima, $restriccio=null) {
        $restriccio=($restriccio==null)?"show":$restriccio;
        $first = 1;
        $previous = ($pagina==1) ? 1 : $pagina-1;
        $next = ($pagina==$paginaMaxima) ? $paginaMaxima : $pagina+1;
        $last = $paginaMaxima;
        
        if ($paginaMaxima==1) {
            return "<div class='table-footer'></div>";
        } else {            
        return "
        <div class='table-footer'>
    		<a href=\"?phrases/$restriccio/$first\">
    			<button class=\"btn\" style='float:left;'><<  Primera</button>
    		</a>
    		<a href=\"?phrases/$restriccio/$previous\">
    			<button class=\"btn\" style='float:left;'><  Anterior</button>
    		</a>
    		<a>
    			<button class=\"btn\" style='float:left;'>Pàgina num. $pagina</button>
    		</a>
            <a href=\"?phrases/$restriccio/$last\">
    			<button class=\"btn\" style='float:right;'>Última  >></button>
    		</a>
    		<a href=\"?phrases/$restriccio/$next\">
    			<button class=\"btn\" style='float:right;'>Següent  ></button>
    		</a>
        </div>";
        }
    }
    
    public function thead() {
        return "<tr>
					<th>Frase</th>
					<th>Autor</th>
					<th>Tema</th>
					<th>Acció</th>
				</tr>";
    }
    
    public function genera_primer_tr() {
        return "<tr>
					<td colspan='3' style='text-align:right;'>Afegir nou element ...</td>
					<td>
                        <a href='?phrases/add'>
						  <img src='../images/edit.svg' style='width:30px; height:30px;' />
                        </a>
					</td>
				</tr>";
    }
    
    public function genera_trs($on) {
        $html="";
        foreach ($on as $frase) {
            $id=$frase->getId();
            $text=$frase->getText();
            $tema=$frase->getTema()->getNom();
            $tema_id=$frase->getTema()->getId();
            $autor=$frase->getAutor()->getNom();
            $autor_id=$frase->getAutor()->getId();
            
            $html .= "
                <tr>
                    <td style='width:65%;'>$text</td>
                    <td style='text-align:center; width:15%;'>
                        <a href='?phrases/author/$autor_id'>$autor</a>
                    </td>
                    <td style='text-align:center; width:10%;'>
                        <a href='?phrases/theme/$tema_id'>$tema</a>
                    </td>
					<td style='width:105%;'>
                        <a href='?phrases/edit/$id'>
						  <img src='../images/edit.svg' style='width:30px; height:30px;' />
                        </a>
                        <a href='?phrases/delete/$id'>
						  <img src='../images/delete.svg' style='width:30px; height:30px;' />
                        </a>
					</td>
				</tr>";
        }
        return $html;
    }
    
    public function html_autor_options($autors, $autor_id=null) {
        $res = "";
        foreach ($autors as $autor) {
            $id=$autor->getId();
            $nom=$autor->getNom();
            if ($id==$autor_id) {
                $res .= "<option value='$id' selected>$nom</option>";
            } else {
                $res .= "<option value='$id'>$nom</option>";
            }
        }
        return $res;
    }
    public function html_tema_options($temes, $tema_id=null) {
        $res = "";
        foreach ($temes as $tema) {
            $id=$tema->getId();
            $nom=$tema->getNom();
            if ($id==$tema_id) {
                $res .= "<option value='$id' selected>$nom</option>";
            } else {
                $res .= "<option value='$id'>$nom</option>";
            }
        }
        return $res;
    }
}

