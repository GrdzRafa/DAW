<div class="weekly-schedule">
	<h1>Estudis</h1>
	<div class="calendar">
	<?php 	
	$i=0;
	foreach (array_reverse($formacio) as $item ) {
	    echo "<div class=\"day-and-activity activity-{$numbers[$i++]}\">\n";
	    echo "<div class=\"day\"><h1>{$item["any"]}</h1></div>\n";
	    echo "<div class=\"activity\"><h2>{$item["titol"]}</h2><p>{$item["descripcio"]}</p>\n";
	    echo "</div></div>";
	}	
	?>
	</div>
</div>
