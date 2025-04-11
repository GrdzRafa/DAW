<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include ("../assets/funcions.php");

$idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
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
							
							<div class="day-and-activity activity-four">
								<div class="day">
									<h1>E12</h1>
								</div>
								<div class="activity">
									<h2>Web Scrapping</h2>
								</div>
								<a href="./activityE12.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							
							<div class="day-and-activity activity-five">
								<div class="day">
									<h1>E13</h1>
								</div>
								<div class="activity">
									<h2>Idiomes</h2>
								</div>
								<a href="./idiomes.php">
									<button class="btn">Veure</button>
								</a>
							</div>
							
						</div>
					</div>


				</div>
			</div>


			</section>
	</main>
</body>
</html>
