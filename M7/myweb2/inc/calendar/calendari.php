<?php 
// $result= EventModel::getAll(); 
// $llistaEvents = $result->fetch_all(MYSQLI_NUM);

// echo "<pre>";
// echo var_dump($llistaEvents);
// echo "</pre>";
?>
<link rel="stylesheet" href="../inc/calendar/style.css">
</head>
<?php include "../inc/main-menu.php"; ?>
<body>
<section id="calendari-event-content">
<div id="calendar-container">
    <div id="calendar">
        <form method="post" action='?Calendari/show' id="calendarForm">
            <div>
                <button type="submit" name="prevYear" class="arrow">&#9664;&#9664;</button>
                <button type="submit" name="prevMonth" class="arrow">&#9664;</button>
                <span id="monthTitle"><?php echo getMonthName($currentDate->format('n')) . " " . $currentDate->format('Y'); ?></span>
                <button type="submit" name="nextMonth" class="arrow">&#9654;</button>
                <button type="submit" name="nextYear" class="arrow">&#9654;&#9654;</button>
            </div>
            <div class="grid">
                <?php
//                 $firstDayOfMonth = new DateTime($currentDate->format('Y-m-01'));
//                 $lastDayOfMonth = new DateTime($currentDate->format('Y-m-t'));
//                 $result = EventModel::getBetweenDates($firstDayOfMonth, $lastDayOfMonth);
//                 if (isset($result)) {
//                     $llistaEvents = $result->fetch_all(MYSQLI_NUM);
//                 }

//                 // Mostrar días de la semana
//                 for ($i = 0; $i < 7; $i++) {
//                     echo "<div class='day'>" . getDayName($i) . "</div>";
//                 }

//                 // Mostrar días del mes
//                 for ($day = 1; $day <= $lastDayOfMonth->format('d'); $day++) {
//                     //pintar de color diferent els dies amb event
//                     foreach ($llistaEvents as $event) {
//                         $data = new DateTime($event[3]);
//                         if ($data->format('d') == $day) {
//                             echo "<div class='day event-day'>" . $day . "</div>";
//                             $day++;
//                         }                    
//                     }
//                     echo "<div class='day'>" . $day . "</div>";
                    
//                 }
//                 ?>
