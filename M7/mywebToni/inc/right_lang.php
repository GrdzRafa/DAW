<div class="lang">
	<?php 
	foreach ($idiomes as $idioma) {
	   echo "<div class=\"flag ";
	   if ($idiomaActiu == $idioma) {
	       echo "actiu";
	   }
	   echo "\"><a href=\"?idiomes/set/{$idioma}\"> <img src=\"../images/lang/{$idioma}.png\" class=\"flag\" /></a></div>";
	    
	}?>
</div>