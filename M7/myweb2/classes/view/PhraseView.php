<?php

class PhraseView extends View
{
    public function show($llistatFrases, $page = 1, $maxPage = 1)
    {
        include $this->file;
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        include "../inc/phrases/phrases-body.php";
        echo "<table id=\"#event-table\">";
        echo "<tr>";
        echo "<th>Frase</th>";
        echo "<th>Autor</th>";
        echo "<th>Tema</th>";
        echo "<th>Acció</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td><a href=\"?Phrase/new\">Afegir frase <i class=\"fa-solid fa-square-plus\"></i></a></td>";
        echo "</tr>";

        foreach ($llistatFrases as $frase) {
            echo "<tr>";
            echo "<td>" . $frase->text . "</td>";
            echo "<td>" . $frase->author->nom . "</td>";
            echo "<td>" . $frase->theme->nom . "</td>";
            echo "<td class=\"icon\">";
            echo "<a href='?Phrase/delete/{$frase->id}' onclick='return confirm(\"Estàs segur de voler eliminar aquesta frase?\")'>";
            echo "<i class=\"far fa-trash-alt\"></i></a>";
            echo "<a href='?Phrase/edit/{$frase->id}'><i class=\"fas fa-edit\"></i></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div id=\"pagination\">";

        if ($page <= 1) {
            echo "<i class=\"fa-solid fa-angles-right fa-flip-horizontal\" style=\"color: #99c1f1;\"></i>";
            echo "<i class=\"fa-solid fa-chevron-right fa-flip-horizontal\" style=\"color: #99c1f1;\"></i>";
        } else {
            echo "<a href=\"?Phrase/show/1\"><i class=\"fa-solid fa-angles-right fa-flip-horizontal\" ></i></a>";
            echo "<a href='?Phrase/show/" . $page - 1 . "'><i class=\"fa-solid fa-chevron-right fa-flip-horizontal\"></i></a>";
        }
        echo "<p>{$page}/{$maxPage}</p>
            <a href=\"?Phrase/show/" . $page + 1 . "\"'><i class=\"fa-solid fa-chevron-right\"></i></a>
            <a href=\"?Phrase/show/{$maxPage}\"><i class=\"fa-solid fa-angles-right\"></i></a>
        </div>";
        echo "</section></main></body></html>";
    }
    public function showEdit($frase, $authors, $themes)
    {
        echo "<!DOCTYPE html><html lang='en'>";
        include "../inc/head.php";
        echo "<body>";
        echo "<main><section>";

        echo "<h2>Editar frase</h2>";
        echo "<form method='POST' action='?Phrase/update/{$frase->id}'>";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$frase->id}\">";
        echo "<label for='text'>Frase:</label>";
        echo "<textarea id='text' name='text' required>{$frase->text}</textarea>";

        echo "<label for='author'>Autor:</label>";
        echo "<select id='author' name='author_id'>";
        foreach ($authors as $author) {
            $selected = ($author->nom == $frase->author->nom) ? "selected" : "";
            echo "<option value='{$author->id}' {$selected}>{$author->nom}</option>";
        }
        echo "</select>";

        echo "<label for='theme'>Tema:</label>";
        echo "<select id='theme' name='theme_id'>";
        foreach ($themes as $theme) {
            $selected = ($theme->nom == $frase->theme->nom) ? "selected" : "";
            echo "<option value='{$theme->id}' {$selected}>{$theme->nom}</option>";
        }
        echo "</select>";

        echo "<div class='buttons'>";
        echo "<button type='submit' class='save-btn'>Guardar</button>";
        echo "<a href='?Phrase/show' class='cancel-btn'>Cancelar</a>";
        echo "</div>";

        echo "</form>";
        echo "</section></main></body></html>";
    }

    public function showCreate($authors, $themes)
    {
        echo "<!DOCTYPE html><html lang='en'>";
        include "../inc/head.php";
        echo "<body>";
        echo "<main><section>";

        echo "<h2>Crear frase</h2>";
        echo "<form method='POST' action='?Phrase/create'>";
        echo "<label for='text'>Frase:</label>";
        echo "<textarea id='text' name='text' required></textarea>";

        echo "<label for='author'>Autor:</label>";
        echo "<select id='author' name='author_id'>";
        foreach ($authors as $author) {
            echo "<option value='{$author->id}'>{$author->nom}</option>";
        }
        echo "</select>";

        echo "<label for='theme'>Tema:</label>";
        echo "<select id='theme' name='theme_id'>";
        foreach ($themes as $theme) {
            echo "<option value='{$theme->id}' {$selected}>{$theme->nom}</option>";
        }
        echo "</select>";

        echo "<div class='buttons'>";
        echo "<button type='submit' class='save-btn'>Crear</button>";
        echo "<a href='?Phrase/show' class='cancel-btn'>Cancelar</a>";
        echo "</div>";

        echo "</form>";
        echo "</section></main></body></html>";
    }
}

