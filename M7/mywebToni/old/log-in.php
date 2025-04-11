<?php 
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include ("../assets/funcions.php");

$idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
include_once ("../langs/vars_{$idiomaActiu}.php");

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["log-in"])) {
    if (strlen($_POST["email"]) == 0) {
        $error["email"]="l'email és obligatori";
    } else {
        $mail = sanitize($_POST["email"],"email");
        if (!validateItem($mail,"email")) {
            $error["email"]="email no vàlid";
        }
    }
    if (strlen($_POST["password"]) == 0) {
        $error["pass"]="la contrasenya és obligatoria";
    } else {
        $pass = sanitize($_POST['password']);
    }
    
    if (!isset($error)) {
        $_SESSION["user"] = "Toni Aguilar";
        $_SESSION["img"] = "uploads/1701505013.0452_shrek.jpg";
        header("location:index.php");
        exit;
    }    
} else if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["registre"])) {
    header("location:registre.php");
    exit;
}
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
			<?php include "../inc/right-content_log.php";?>			
		</section>
	</main>
</body>
</html>
