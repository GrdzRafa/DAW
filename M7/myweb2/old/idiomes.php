<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include ("../assets/funcions.php");

$idiomes = array("cat","euz","es","gb","fr","de");
//$idiomaActiu = "de";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lang"])) {
    $_lang = sanitize($_GET["lang"]);
    if (in_array($_lang, $idiomes)) {
        $idiomaActiu = $_lang;
        $res=setcookie("lang",$_lang, time()+86400 * 30); //86400 és 1 dia
    }
} else {
    $idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
}

include_once ("../langs/vars_{$idiomaActiu}.php");

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

		<section class="content">
			<?php include "../inc/div_left_content.php";?>
			<?php include "../inc/right-content_lang.php";?>			
		</section>
	</main>
</body>
</html>
