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

		<li class="nav-item <?php echo ($menu_actiu=="perfil") ? "active": ""; ?>"><b></b> <b></b> <a href="?profile/show"> 
			<i class="fa fa-user nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_02)) ? $nav_02 : ""; ?>
				</span>
		</a></li>

		<li class="nav-item <?php echo ($menu_actiu=="horari") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?schedule/show"> 
				<i class="fa fa-calendar-check nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_03)) ? $nav_03 : ""; ?>
				</span>
		</a></li>
		
		<?php 
		if (isset($_SESSION['user'])) {?>
		<li class="nav-item <?php echo ($menu_actiu=="maintenance") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?maintenance/show"> 
				<i class="fa fa-pencil nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_06)) ? $nav_06 : ""; ?>
				</span>
		</a></li>
		<?php }?>

		<li class="nav-item <?php echo ($menu_actiu=="activitats") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?activities/show"> 
				<i class="fa fa-person-running nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_04)) ? $nav_04 : ""; ?>
				</span>
		</a></li>

		<li class="nav-item <?php echo ($menu_actiu=="configuracions") ? "active": ""; ?>"><b></b> <b></b> 
			<a href="?settings/show"> 
				<i class="fa fa-sliders nav-icon"></i> 
				<span class="nav-text">
					<?php echo (isset($nav_05)) ? $nav_05 : ""; ?>
				</span>
		</a></li>
	</ul>
</nav>