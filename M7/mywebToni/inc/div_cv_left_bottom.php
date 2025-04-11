<div class="weekly-schedule">
	<h1><?php echo (isset($cv_exp_00)) ? $cv_exp_00 : ""; ?></h1>
	<div class="calendar">

	<?php 	
	$i=0;
	foreach (array_reverse($experiencia) as $item ) {
	    echo "<div class=\"day-and-activity activity-{$numbers[$i++]}\">\n";
	    echo "<div class=\"day\"><h1>{$item["day"]}</h1></div>\n";
	    echo "<div class=\"activity\"><h2>{$item["titol"]}</h2><p>{$item["subtitol"]}</p><p>{$item["desc"]}</p>\n";
	    echo "</div></div>";
	}	
	?>

	</div>
</div>
