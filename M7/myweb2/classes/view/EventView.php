<?php

class EventView extends View
{
    
    private $llistatEvents;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($llistatEvents) {
        $this->llistatEvents = $llistatEvents;
        include $this->file;
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        include "../inc/event/event-body.php";
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td><a href=\"?Event/addForm\">Afegir</a></td>";
        echo "</tr>";
        
        $this->showEventList($this->llistatEvents);
        
        echo "</table></section></main></body></html>";
    }
    
    
    
    
    private function showEventList($llistatEvents){
        foreach ($llistatEvents as $event){
            echo "<tr>";
            echo "<td> $event[0] </td>";
            echo "<td> $event[1] </td>";
            echo "<td> $event[3]  </td>";
            echo "<td> $event[4]  </td>";
            echo "<td>";
            if (!empty($event[5])) {
                $tags = explode(';', $event[5]);
                foreach ($tags as $tag) {
                    echo "<span class=\"tag\">$tag</span> ";
                }
            }
            echo "</td>";
            echo "<td> $event[2] </td>";
            
            echo "<td class=\"icon\">";
            echo "<form method='POST' action='?Event/delete' onsubmit='return confirm(\"¿Estás seguro de eliminar este evento?\")'>";
            echo "<input type='hidden' name='delete-event-id' value='$event[0]'>";
            echo "<button type='submit' class='delete-btn'><i class=\"far fa-trash-alt\"></i></button>";
            echo "</form>";
            
            echo "<a href='editEvent.php?id=$event[0]'><i class=\"fas fa-edit\"></i></a>";
            
            echo "</td>";
            echo "</tr>";
        }
    }
    
    public function showAddForm(){
        include $this->file;
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        echo '<form method="POST" action="?Event/add">';
        echo '<table>';;
        echo '<tr>';
        echo '<td>Nombre del Evento</td>';
        echo '<td><input type="text" name="nombre" required /></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Data i hora inici</td>';
        echo '<td><input type="datetime-local" name="fecha_inicio" required /></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Data i hora final</td>';
        echo '<td><input type="datetime-local" name="fecha_fin" required /></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Descripcion</td>';
        echo '<td><input type="text" name="lugar" required /></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Descripción</td>';
        echo '<td><textarea name="descripcion" required></textarea></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="2">';
        echo '<button type="submit" name="submit" value="create">Crear</button>';
        echo '<a href="?Event/show"><button type="button">Cancelar</button></a>';
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</form>';
    }
    
    
    
    
//     public function delete() {
//         echo "hola3";
//         include $this->file;
        
//         echo "<!DOCTYPE html><html lang=\"en\">";
//         include "../inc/head.php";
//         include "../inc/event/event-body.php";
//         echo "</section></main></body></html>";
//     }
}

