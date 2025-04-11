<?php 
session_start();
include_once ("../inc/vars.php");

?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/head.php"; ?>
<body>
	<main>
		<?php
        $menu_actiu = "perfil";
        $numbers = array("one", "two", "three", "four", "five", "six");
         
        $experiencia[] = array(
            "day" => "2018-19",
            "titol" => "Professor Institut Thos i Codina",
            "subtitol" => "Mòduls M04 i M05 a primer i M03 i M07 a segon",
            "desc" => "Tutor de DAW 2A");
        $experiencia[] = array(
            "day" => "2019-20",
            "titol" => "Professor Institut Thos i Codina",
            "subtitol" => "Mòduls M04 i M05 a primer i M03 i M07 a segon",
            "desc" => "Cap de Seminari");
        $experiencia[] = array(
            "day" => "2020-21",
            "titol" => "Professor Institut Thos i Codina",
            "subtitol" => "Mòduls M04 i M05 a primer i M03 i M07 a segon",
            "desc" => "Cap de Departament");
        $experiencia[] = array(
            "day" => "2021-22",
            "titol" => "Professor Institut Thos i Codina",
            "subtitol" => "Mòduls M05 a primer i M03, M07 i Projecte a segon",
            "desc" => "Tutor DAW 1A");
        $experiencia[] = array(
            "day" => "2022-23",
            "titol" => "Professor Institut Thos i Codina",
            "subtitol" => "Mòduls M05 a primer i M03, M07 i Projecte a segon",
            "desc" => "Tutor DAW 1A");
        $experiencia[] = array(
            "day" => "2023-24",
            "titol" => "Professor Institut Thos i Codina",
            "subtitol" => "Mòduls M02 i M05 a primer i M03 i M07 a segon",
            "desc" => "Tutor DAW 1A");
        
        $formacio[] = array(
            "any" => 1990,
            "titol" => "CERTIFICAT NIVELL INTERMEDI ANGLÈS - Quart curs (E.O.I.)",
            "descripcio" => "Les escoles oficials d’idiomes (EOI) són centres públics d’ensenyament d’idiomes moderns, no universitaris, que imparteixen els ensenyaments especialitzats regulats per la LOE." );
        $formacio[] = array(
            "any" => 2009,
            "titol" => "ENGINYERIA TÈCNICA EN INFORMÀTICA DE GESTIÓ - U.A.B.",
        "descripcio" => "El grau en Enginyeria Informàtica té com a objectiu formar professionals experts en informàtica que tinguin una visió global de la tecnologia que els permeti analitzar, dissenyar, desenvolupar i implantar sistemes informàtics per a diversos entorns i situacions, adaptant-se als canvis i a les innovacions tecnològiques.");
        $formacio[] = array(
            "any" => 2010,
            "titol" => "FIRST CERTIFICATE IN ENGLISH (B2)",
        "descripcio" => "El màster universitari en Formació del Professorat d'Educació Secundària Obligatòria i Batxillerat, Formació Professional i Ensenyament d'Idiomes té com objectiu principal, proporcionar la formació pedagògica i didàctica necessària per exercir la docència en l'Educació Secundària Obligatòria, Batxillerat i Formació Professional específica.");
        $formacio[] = array(
            "any" => 2011,
            "titol" => "MÀSTER FORMACIÓ PROFESSORAT (TECNOLOGIA) - U.P.C.",
            "descripcio" => "El màster universitari en Formació del Professorat d'Educació Secundària Obligatòria i Batxillerat, Formació Professional i Ensenyament d'Idiomes té com objectiu principal, proporcionar la formació pedagògica i didàctica necessària per exercir la docència en l'Educació Secundària Obligatòria, Batxillerat i Formació Professional específica.");
        
        $perfil[] = "Soc Juan Antonio Aguilar Amo, professor de l'Institut Thos i Codina i he preparat aquest examen perque puguis desmostrar-me tot el que saps fer.";
        $perfil[] = "Em considero una persona autodidacta, amb moltes inquietuds, molt polida i ordenada quant als meus codis es refereix i també molt	perfecionista amb la meva feina.";
        $perfil[] = "M'agrada el tracte amb la gent i sobretot ensenyar i transmetre coneixement";
        
        include "../inc/main-menu.php";
        ?>

		<section class="cv content">
			<?php include "../inc/div_cv_left_content.php"; ?>
			
			<?php include "../inc/div_cv_right_content.php"; ?>
		</section>
	</main>
</body>
</html>
