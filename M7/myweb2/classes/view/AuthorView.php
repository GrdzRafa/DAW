<?php


class AuthorView extends View
{
    public function show($llistatAutors, $page = 1, $maxPage = 1)
    {
        include $this->file;
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        include "../inc/phrases/phrases-body.php";
        echo "<table id=\"#event-table\">";
        echo "<tr>";
        echo "<th>Autor</th>";
        echo "<th>Desripcio</th>";
        echo "<th>Num de frases</th>";
        echo "<th>Acció</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td><a href=\"?Author/new\">Afegir autor <i class=\"fa-solid fa-square-plus\"></i></a></td>";
        echo "</tr>";

        foreach ($llistatAutors as $author) {
            echo "<tr>";
            echo "<td>" . $author->nom . "</td>";
            echo "<td>" . $author->descripcio . "</td>";
            echo "<td>{$author->numFrases}</td>";
            echo "<td class=\"icon\">";
            echo "<a href='?Author/delete/{$author->id}' onclick='return confirm(\"Estàs segur de voler eliminar aquest autor?\")'>";
            echo "<i class=\"far fa-trash-alt\"></i></a>";
            echo "<a href='?Author/edit/{$author->id}'><i class=\"fas fa-edit\"></i></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div id=\"pagination\">";

        if ($page <= 1) {
            echo "<i class=\"fa-solid fa-angles-right fa-flip-horizontal\" style=\"color: #99c1f1;\"></i>";
            echo "<i class=\"fa-solid fa-chevron-right fa-flip-horizontal\" style=\"color: #99c1f1;\"></i>";
        } else {
            echo "<a href=\"?Author/show/1\"><i class=\"fa-solid fa-angles-right fa-flip-horizontal\" ></i></a>";
            echo "<a href='?Author/show/" . $page - 1 . "'><i class=\"fa-solid fa-chevron-right fa-flip-horizontal\"></i></a>";
        }

        echo "<p>{$page}/{$maxPage}</p>
        <a href=\"?Author/show/" . $page + 1 . "\"'><i class=\"fa-solid fa-chevron-right\"></i></a>
        <a href=\"?Author/show/{$maxPage}\"><i class=\"fa-solid fa-angles-right\"></i></a>
        </div>";
        echo "</section></main></body></html>";
    }

    public function showEdit($author)
    {
        echo "<!DOCTYPE html><html lang='en'>";
        include "../inc/head.php";
        echo "<body>";
        echo "<main><section>";

        echo "<h2>Editar autor</h2>";
        echo "<form method='POST' action='?Author/update/{$author->id}'>";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$author->id}\">";

        echo "<label for='nom'>Autor:</label>";
        echo "<input type=\"text\" name=\"nom\" value=\"{$author->nom}\">";

        echo "<label for='descripcio'>Descripció:</label>";
        echo "<textarea id='descripcio' name='descripcio' required>{$author->descripcio}</textarea>";

        echo "<div class='buttons'>";
        echo "<button type='submit' class='save-btn'>Guardar</button>";
        echo "<a href='?Author/show' class='cancel-btn'>Cancelar</a>";
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

        echo "<h2>Crear autor</h2>";
        echo "<form method='POST' action='?Author/create'>";

        echo "<label for='nom'>Autor:</label>";
        echo "<input type=\"text\" name=\"nom\" required>";

        echo "<label for='descripcio'>Descripció:</label>";
        echo "<textarea id='descripcio' name='descripcio' required></textarea>";

        echo "<div class='buttons'>";
        echo "<button type='submit' class='save-btn'>Crear</button>";
        echo "<a href='?Author/show' class='cancel-btn'>Cancelar</a>";
        echo "</div>";

        echo "</form>";
        echo "</section></main></body></html>";
    }
}

