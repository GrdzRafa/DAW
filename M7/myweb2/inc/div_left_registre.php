<section class="infos">
	<!-- multistep form -->
	<form id="msform" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		<!-- progressbar -->
		<ul id="progressbar">
			<li class="active">Dades d'accés</li>
			<li>Dades Personals</li>
			<li>Altres dades</li>
		</ul>
		<!-- fieldsets -->
		<fieldset>
			<h2 class="fs-title">Crea el teu compte d'usuari</h2>
			<h3 class="fs-subtitle">Aquest és el primer pas</h3>
				<?php
				echo (isset($errorsDetectats["error"]))? "<span class=\"error\">{$errorsDetectats["error"]}</span>":"";
                echo $input_email;
                echo $input_pass;
                echo $input_cpass;
                echo $input_bNext;
                ?>
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Dades personals</h2>
			<h3 class="fs-subtitle">Entra les teves dades personals</h3>
				<?php
                echo $select_Tipus;
                echo $input_dni;
                echo $input_nom;
                echo $input_cognoms;
                echo $select_Sexe;
                echo $input_naixement;
                echo $input_bPrev;
                echo $input_bNext;
                ?>
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Altres dades</h2>
			<h3 class="fs-subtitle">Si vols, pots afegir una imatge teva</h3>
			<?php
            echo $input_adreca;
            echo $input_cp;
            echo $input_poblacio;
            echo $input_provincia;
            echo $input_telefon;
            ?>
			<label for="imatge">Selecciona una imatge</label>
			<?php
            echo $input_maxFileSize;
            echo $input_imatge;
            echo (isset($errorsDetectats["baseDades"]))?"<span class=\"error\" >{$errorsDetectats["baseDades"]}</span>":"";
            echo $input_bPrev;
            echo $input_bSend;
            ?>
		</fieldset>
	</form>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
	<script src="../js/registre.js"></script>
</section>
