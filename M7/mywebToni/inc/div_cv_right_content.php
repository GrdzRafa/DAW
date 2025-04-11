<div class="cv-right-content">
	<div class="user-info">
		<div class="icon-container"></div>
		<h4></h4>
		<img />
	</div>
	<div class="about">
		<h1 style="align-self: flex-start; padding: 10px;">Sobre mi</h1>
		<div>
		<?php 
		foreach ($perfil as $item) {
		    echo "<p>$item</p>\n";
		}
		?>
		</div>
	</div>

	<div class="user-img">
		<img style="border-radius: 50%; width: 80%;" src="../images/f1.jpg">
		<h2>Toni Aguilar</h2>
	</div>
</div>
