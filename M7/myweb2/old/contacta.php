<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include_once ("../inc/vars.php");
include ("../assets/funcions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (strlen($_POST["nom"]) == 0) {
        $errors["nom"] = "El camp nom és obligatori";
    } else {
        $frm_nom = (validateItem($_POST["nom"], "alfanum")) ? sanitize($_POST["nom"]) : "";
        if ($frm_nom == "")
            $errors["nom"] = "El camp NOM no ha passat les validacions";
    }
    if (strlen($_POST["email"]) == 0) {
        $errors["email"] = "El camp email és obligatori";
    } else {
        $frm_email = (validateItem($_POST["email"], "email")) ? sanitize(strtolower($_POST["email"]), "email") : "";
        if ($frm_email == "")
            $errors["email"] = "El camp EMAIL no ha passat les validacions";
    }
    if (strlen($_POST["telefon"]) > 0) {
        $frm_telefon = (validateItem($_POST["telefon"], "phone")) ? sanitize($_POST["telefon"], "int") : "";
        if ($frm_telefon == "")
            $errors["telefon"] = "El camp TELEFON no ha passat les validacions";
    }
    if (strlen($_POST["assumpte"]) == 0) {
        $errors["assumpte"] = "El camp assumpte és obligatori";
    } else {
        $frm_assumpte = (validateItem($_POST["assumpte"], "alfanum")) ? sanitize($_POST["assumpte"]) : "";
        if ($frm_assumpte == "")
            $errors["assumpte"] = "El camp ASSUMPTE no ha passat les validacions";
    }
    if (strlen($_POST["missatge"]) == 0) {
        $errors["missatge"] = "El camp missatge és obligatori";
    } else {
        $frm_missatge = (validateItem($_POST["missatge"], "alfanum")) ? sanitize($_POST["missatge"]) : "";
        if ($frm_missatge == "")
            $errors["missatge"] = "El camp MISSATGE no ha passat les validacions";
    }

    if (! isset($errors)) {
        $contingut = file_get_contents("../files/contacta.xml");
        if ($contingut === false) {
            $contingut = "<contactes>";
        } elseif (strlen($contingut)>0) {
           $contingut = substr($contingut, 0, -12);
        } else {
            $contingut = "<contactes>";
        }
        $avui = getdate();
        $contingut .= "<contacte><data>{$avui['mday']}/{$avui['mon']}/{$avui['year']}</data>\n";
        $contingut .= "<nom>".html_entity_decode($frm_nom)."</nom>\n";
        $contingut .= "<email>".html_entity_decode($frm_email)."</email>\n";
        $contingut .= "<telefon>".html_entity_decode($frm_telefon)."</telefon>\n";
        $contingut .= "<assumpte>".html_entity_decode($frm_assumpte)."></assumpte>\n";
        $contingut .= "<missatge>".html_entity_decode($frm_missatge)."</missatge>\n";
        $contingut .= "</contacte></contactes>";
        if (file_put_contents("../files/contacta.xml", $contingut)) {
            unset($frm_nom);
            unset($frm_email);
            unset($frm_telefon);
            unset($frm_assumpte);
            unset($frm_missatge);
            $enviat = true;
        } else {
            echo "Hi ha hagut algun problema a l'escriure el fitxer. <br>Posa't en contacte amb l'administrador (el Toni)";
        }
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/head.php"; ?>
<body>
	<main>
		<?php
$menu_actiu = "principal";
include "../inc/main-menu.php";
?>

		<div class="left-content">
			<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
				method="post">
				<h1>Formulari de contacte</h1><br/>
				<label for="name">El teu nom (*): </label> <input type="text"
					<?php echo (isset($errors['nom'])) ? "class=\"error\" placeholder=\"{$errors['nom']}\"":" value=\"$frm_nom\"";?>
					id="nom" name="nom" minlength="4" maxlength="40" size="10" /><br />
				<label for="email">Correu electrónic (*): </label> <input
					type="text"
					<?php echo (isset($errors['email'])) ? "class=\"error\" placeholder=\"{$errors['email']}\"":" value=\"$frm_email\"";?>
					id="email" name="email" minlength="10" maxlength="60" size="10" /><br />
				<label for="telefon">Telèfon: </label> <input type="text"
					<?php echo (isset($errors['telefon'])) ? "class=\"error\" placeholder=\"{$errors['telefon']}\"":" value=\"$frm_telefon\"";?>
					id="telefon" name="telefon" minlength="9" maxlength="14" /> <br />
				<label for="assumpte">Assumpte (*): </label> <input type="text"
					<?php echo (isset($errors['assumpte'])) ? "class=\"error\" placeholder=\"{$errors['assumpte']}\"":" value=\"$frm_assumpte\"";?>
					id="assumpte" name="assumpte" minlength="5" maxlength="60" /> <br />
				<label for="missatge">Missatge (*): </label><br />
				<textarea
					<?php echo (isset($errors['missatge'])) ? "class=\"error\" placeholder=\"{$errors['missatge']}\"":"";?>
					id="missatge" name="missatge" rows="8" cols="80"><?php echo (!isset($errors['missatge'])) ? $frm_missatge : ""; ?></textarea>
				<br /> 
				<?php if ($enviat) { ?>
					<div class="activity-three"><label>Dades enviades correctament.</label></div><br />
				<?php } else { ?>
					<label>(*)Camp obligatori.</label><br />
				<?php }?>
				<button class="btn" name="boto" value="Envia">Envia les dades</button>
			</form>
		</div>
	</main>
</body>
</html>
