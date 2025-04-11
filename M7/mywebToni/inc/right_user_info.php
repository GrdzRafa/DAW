<div class="user-info">
	<div class="icon-container">
		<a href="?Idiomes/show"> 
			<i class="fa fa-globe nav-icon"></i>
		</a> 
		<a href="news_letter.php"> 
			<i class="fa fa-bell nav-icon"></i>
		</a> 
		<a href="?Contacta/show"> 
			<i class="fa fa-message nav-icon"></i>
		</a> 
		<a href="llibre_de_visites.php"> 
			<i class="fa fa-book nav-icon"></i>
		</a>
	</div>
	<?php 
	echo "<h4>";
	if (isset($_SESSION["user"])) {
        echo $_SESSION["user"];
        echo "</h4>";
        echo "<a href=\"?user/log_out\">";
        echo "<img src=\"{$_SESSION["img"]}\" alt=\"user\" />";
        echo "</a>";
        
	} else {
	    echo (isset($main_right_0101)) ? $main_right_0101 : "" ;
	    echo "</h4>";
	    echo "<a href=\"?user/log_in\">";
	    echo "<img src=\"../images/usuari-not-logged.png\" alt=\"user\" />";
	    echo "</a>";
	}
	?>
</div>
