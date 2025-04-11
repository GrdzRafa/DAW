<nav class="main-menu">
	<div>
		<img style="width: 100%;" class="logo" src="../images/logo.png" alt="" />
	</div>
	<h1>DAW M07</h1>
	<ul>
		<li class="nav-item <?php echo ($menu_actiu=="principal") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="index.php"> 
				<i class="fa fa-house nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_01)) ? $nav_01 : ""; ?>
				</span>
		</a></li>

		<li class="nav-item <?php echo ($menu_actiu=="perfil") ? "active": ""; ?>"><b></b> <b></b> <a href="profile.php"> 
			<i class="fa fa-user nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_02)) ? $nav_02 : ""; ?>
				</span>
		</a></li>

		<li class="nav-item <?php echo ($menu_actiu=="horari") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?Calendari/show"> 
				<i class="fa fa-calendar-check nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_03)) ? $nav_03 : ""; ?>
				</span>
		</a></li>
		<!-- EVENTS (OCULTAR MÁS ADELANTE PARA USUARIOS NO LOGEADOS/VALIDADOS) -->
		<li class="nav-item <?php echo ($menu_actiu=="configuracions") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?Event/show"> 
				<i class="fa fa-sliders nav-icon"></i> 
				<span class="nav-text">
					Events
				</span>
		</a></li>
		
		<li class="nav-item <?php echo ($menu_actiu=="activitats") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="activities.php"> 
				<i class="fa fa-person-running nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_04)) ? $nav_04 : ""; ?>
				</span>
		</a></li>

		<li class="nav-item <?php echo ($menu_actiu=="configuracions") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="settings.php"> 
				<i class="fa-solid fa-gear nav-icon"></i>
				<span class="nav-text">
					<?php echo (isset($nav_05)) ? $nav_05 : ""; ?>
				</span>
		</a></li>
		<li class="nav-item <?php echo ($menu_actiu=="configuracions") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?Phrase/show"> 
				<i class="fa-solid fa-feather nav-icon"></i>
				<span class="nav-text">
					Frases
				</span>
			</a>
		</li>
	</ul>
</nav>