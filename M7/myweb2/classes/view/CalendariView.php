<?php

class CalendariView extends View {
    
    private $llistaEvents;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show(DateTime $currentDate) {

        include "../inc/calendar/functions.php";
        include $this->file;
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "../inc/head.php";
        include "../inc/calendar/calendari.php";
        $this->showCalendar($currentDate);
        
        echo "</div>
        <input type=\"hidden\" name=\"date\" value=\"". $currentDate->format('Y-m-d') ."\">
        </form>
        </div>";
        
        echo "<!-- Secció events -->";
        echo "<aside class=\"events-section\">";
        echo "<h2>Eventos</h2>
            <ul>";    
        $this->showCalendarEventList($this->llistaEvents, $currentDate);
        echo "</ul>
           </aside>
           </div>
           </section>
           <script src=\"../inc/calendar/script.js\"></script>
            </body></html>";
    }
    
    private function showCalendar(DateTime $currentDate){
        $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
        $lastDayOfMonth = new DateTime($currentDate->format('Y-m-t'));
        $result = EventModel::getBetweenDates($firstDayOfMonth, $lastDayOfMonth);
        
        if (isset($result)) {
            $llistaEvents = $result->fetch_all(MYSQLI_NUM);
            $this->llistaEvents = $llistaEvents;
        }
        
        // Mostrar días de la semana
        for ($i = 0; $i < 7; $i++) {
            echo "<div class='day'>" . getDayName($i) . "</div>";
        }
        
        // Mostrar días del mes
        for ($day = 1; $day <= $lastDayOfMonth->format('d'); $day++) {
            //pintar de color diferent els dies amb event
            foreach ($llistaEvents as $event) {
                $data = new DateTime($event[3]);
                if ($data->format('d') == $day) {
                    echo "<div class='day event-day'>" . $day . "</div>";
                    $day++;
                }
            }
            echo "<div class='day'>" . $day . "</div>";
            
        }
    }
    
    private function showCalendarEventList($llistaEvents, DateTime $currentDate){

        // Mostrar eventos del mes actual
        foreach ($llistaEvents as $event) {
            $eventDate = new DateTime($event[3]);
            if ($eventDate->format('Y-m') === $currentDate->format('Y-m')) {
                echo "<li>$event[2]</li>";
            }
        }
    }
}
