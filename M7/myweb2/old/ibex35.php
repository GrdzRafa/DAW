<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
session_start();

if (!isset($_SESSION["user"])) {
    header("location:log-in.php");
    exit;
}

include ("../assets/funcions.php");

$idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
include_once ("../langs/vars_{$idiomaActiu}.php");

$newTable = webScrappingInversis();
$taula = html_generateTable($newTable);
$_SESSION["cotis"] = $newTable;

?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/head.php"; ?>
<body>
	<main>
		<?php
		$menu_actiu="principal";
		include "../inc/main-menu.php"; 
		?>


		<div class="left-content">
		<?php echo $taula; ?>			
		</div>
		
		
	</main>
</body>
</html>
