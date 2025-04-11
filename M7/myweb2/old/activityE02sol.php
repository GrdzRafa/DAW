<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include '../inc/vars.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../inc/head.php'; ?>
<body>
	<main>
		<nav class="main-menu">
			<h1><img class="logo" src="../images/logo.png" alt="" /></h1>
			<h1>DAW M07</h1>
			<ul>
				<li class="nav-item"><b></b> <b></b> 
					<a href="index.php"> 
						<i class="fa fa-house nav-icon"></i> 
						<span class="nav-text">Home</span>
					</a>
				</li>

				<li class="nav-item"><b></b> <b></b> 
					<a href="profile.php"> 
						<i class="fa fa-user nav-icon"></i> 
						<span class="nav-text">Profile</span>
					</a>
				</li>

				<li class="nav-item"><b></b> <b></b> 
					<a href="schedule2409.php"> 
						<i class="fa fa-calendar-check nav-icon"></i> 
						<span class="nav-text">Schedule</span>
					</a>
				</li>

				<li class="nav-item active"><b></b> <b></b> 
					<a href="activities.php"> 
						<i class="fa fa-person-running nav-icon"></i> 
						<span class="nav-text">Activities</span>
					</a>
				</li>

				<li class="nav-item"><b></b> <b></b> 
					<a href="settings.php"> 
						<i class="fa fa-sliders nav-icon"></i> 
						<span class="nav-text">Settings</span>
					</a>
				</li>
			</ul>
		</nav>

	<section class="contingut-practica">
		<div class="left-content">
			<div class="activities">
				<h1>UF1 Desenvolupament web en entorn servidor</h1>
				<div class="left-bottom">
					<div class="weekly-schedule">
						<h1>Exercicis de Programació en PHP</h1>
						<div class="calendar">
							<div class="day-and-activity activity-one">
								<div class="day">
									<h1>E02</h1>
								</div>
								<div class="activity">
									<h2>Arrodonir</h2>
								</div>
								<a href="./activityE02.php">
									<button class="btn">Veure</button>
								</a>
							</div>

							<div class="day-and-activity activity-two">
								<div class="day">
									<h1>E03</h1>
								</div>
								<div class="activity">
									<h2>Càlculs matemàtics</h2>
								</div>
								<a href="./activityE03.php">
									<button class="btn">Veure</button>
								</a>
							</div>

							<div class="day-and-activity activity-three">
								<div class="day">
									<h1>E04</h1>
								</div>
								<div class="activity">
									<h2>Calcular l'edat</h2>
								</div>
								<a href="./activityE04.php">
									<button class="btn">Veure</button>
								</a>
							</div>

							<div class="day-and-activity activity-four">
								<div class="day">
									<h1>E05</h1>
								</div>
								<div class="activity">
									<h2>Escacs</h2>
								</div>
								<a href="./activityE05.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							
							<div class="day-and-activity activity-five">
								<div class="day">
									<h1>E06</h1>
								</div>
								<div class="activity">
									<h2>Punts de la brisca</h2>
								</div>
								<a href="./activityE06.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							
							<div class="day-and-activity activity-six">
								<div class="day">
									<h1>E07</h1>
								</div>
								<div class="activity">
									<h2>Buscar una cadena</h2>
								</div>
								<a href="./activityE07.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							
							<div class="day-and-activity activity-one">
								<div class="day">
									<h1>E08</h1>
								</div>
								<div class="activity">
									<h2>Complexitat de les contrasenyes</h2>
								</div>
								<a href="./activityE08.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							<div class="day-and-activity activity-two">
								<div class="day">
									<h1>E09</h1>
								</div>
								<div class="activity">
									<h2>Escacs</h2>
								</div>
								<a href="./activityE09.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							
							<div class="day-and-activity activity-three">
								<div class="day">
									<h1>E10</h1>
								</div>
								<div class="activity">
									<h2>Generador d'elements html</h2>
								</div>
								<a href="./activityE10.php">
									<button class="btn">Veure</button>
								</a>
							</div>
						</div>
					</div>

					<div class="personal-bests">
						<h1>Pràctica E02 - Arrodonir</h1>
						<div class="practica-desc">
							<p>Definit un número amb n decimals, defineix un script per tal d'arrodonir-ho amb m decimals.</p>
							<p>No facis servir la funció round.</p>
							<br/><br/>
							
<pre style="font-size:1.0rem;">
<code style="color:red;">&lt;?php</code>
$numero = 3.19324;
$decimals = 3;

$numeroSenseDecimals = (int) ($numero*pow(10,$decimals));

$ultim = ((int) ($numero*pow(10,$decimals+1)))%10;

if ($ultim>=5) {
    $numeroSenseDecimals++;
}

echo $numeroSenseDecimals/pow(10,$decimals);
<code style="color:red;">?></code>
</pre>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</main>
</body>
</html>
