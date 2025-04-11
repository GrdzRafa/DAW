<?php

class ThemeView extends View
{
    public function show($llistatTemes, $page = 1, $maxPage = 1)
    {
        //         echo "<pre>";
        //         echo var_dump($llistatAutors);
        //         echo "</pre>";
        include $this->file;
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        include "../inc/phrases/phrases-body.php";
        echo "<table id=\"#event-table\">";
        echo "<tr>";
        echo "<th>Tema</th>";
        echo "<th>Desripcio</th>";
        echo "<th>Num. de frases</th>";
        echo "<th>Acció</th>";
        echo "</tr>";
        echo "</tr>";
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td><a href=\"?Theme/new\">Afegir tema <i class=\"fa-solid fa-square-plus\"></i></a></td>";
        echo "</tr>";
        
        foreach ($llistatTemes as $theme) {
            echo "<tr>";
            echo "<td>".$theme->nom."</td>";
            echo "<td>".$theme->descripcio."</td>";
            echo "<td>".$theme->numFrases."</td>";
            echo "<td class=\"icon\">";
            echo "<a href='?Theme/delete/{$theme->id}' onclick='return confirm(\"Estàs segur de voler eliminar aquest tema?\")'>";
            echo "<i class=\"far fa-trash-alt\"></i></a>";
            echo "<a href='?Theme/edit/{$theme->id}'><i class=\"fas fa-edit\"></i></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div id=\"pagination\">";

        if ($page <= 1) {
            echo "<i class=\"fa-solid fa-angles-right fa-flip-horizontal\" style=\"color: #99c1f1;\"></i>";
            echo "<i class=\"fa-solid fa-chevron-right fa-flip-horizontal\" style=\"color: #99c1f1;\"></i>";
        } else {
            echo "<a href=\"?Theme/show/1\"><i class=\"fa-solid fa-angles-right fa-flip-horizontal\" ></i></a>";
            echo "<a href='?Theme/show/" . $page - 1 . "'><i class=\"fa-solid fa-chevron-right fa-flip-horizontal\"></i></a>";
        }

        echo "<p>{$page}/{$maxPage}</p>
        <a href=\"?Theme/show/" . $page + 1 . "\"'><i class=\"fa-solid fa-chevron-right\"></i></a>
        <a href=\"?Theme/show/{$maxPage}\"><i class=\"fa-solid fa-angles-right\"></i></a>
        </div>";
        echo "</section></main></body></html>";
    }

    
    public function showEdit($theme)
    {
        echo "<!DOCTYPE html><html lang='en'>";
        include "../inc/head.php";
        echo "<body>";
        echo "<main><section>";

        echo "<h2>Editar tema</h2>";
        echo "<form method='POST' action='?Theme/update/{$theme->id}'>";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$theme->id}\">";

        echo "<label for='nom'>Tema:</label>";
        echo "<input type=\"text\" name=\"nom\" value=\"{$theme->nom}\">";

        echo "<label for='descripcio'>Descripció:</label>";
        echo "<textarea id='descripcio' name='descripcio' required>{$theme->descripcio}</textarea>";

        echo "<div class='buttons'>";
        echo "<button type='submit' class='save-btn'>Guardar</button>";
        echo "<a href='?Theme/show' class='cancel-btn'>Cancelar</a>";
        echo "</div>";

        echo "</form>";
        echo "</section></main></body></html>";
    }

    public function showCreate()
    {
        echo "<!DOCTYPE html><html lang='en'>";
        include "../inc/head.php";
        echo "<body>";
        echo "<main><section>";

        echo "<h2>Crear tema</h2>";
        echo "<form method='POST' action='?Theme/create'>";

        echo "<label for='nom'>Tema:</label>";
        echo "<input type=\"text\" name=\"nom\" required>";

        echo "<label for='descripcio'>Descripció:</label>";
        echo "<textarea id='descripcio' name='descripcio' required></textarea>";

        echo "<div class='buttons'>";
        echo "<button type='submit' class='save-btn'>Crear</button>";
        echo "<a href='?Theme/show' class='cancel-btn'>Cancelar</a>";
        echo "</div>";

        echo "</form>";
        echo "</section></main></body></html>";
    }
}

