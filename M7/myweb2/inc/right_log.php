<div class="active-calories">
	<h1 style="align-self: flex-start">Identifica't</h1>
	<form action="" method="post">
		<div class="log-in">

			<label for="mail">E-mail: </label> 
			<input type="text" id="mail" name="email" 
				<?php 
				echo "value=\"$mail\"";
				echo (isset($error["email"]))? " class=\"error\"" : "";
				echo (isset($error["email"]))? " placeholder= \"{$error["email"]}\"": "placeholder= \"entra l'email\"";
				?> /> 
			<label for="password">Password:</label> 
			<input type="password" id="password" name="password"
				<?php 
				echo "value=\"$pass\"";
				echo (isset($error["pass"]))? " class=\"error\"" : "";
				echo (isset($error["pass"]))? " placeholder= \"{$error["pass"]}\"": "placeholder= \"entra la contrasenya\"";
				?> />
		</div>
		<input type="submit" name="log-in" value="Entra" /> 
		<input type="submit" name="registre" value="Registre" />
	</form>
</div>