<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thos i Codina - Desenvolupament web en entorn servidor</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>
	<link rel="stylesheet" href="../css/style.css?v=1.2">
</head>
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
						<h1>Pràctica E05 - Punts de la brisca</h1>
						<div class="practica-desc">
							<p>Realitza un programa que triï a l'atzar 10 cartes de la baralla espanyola i que digui quants punts sumen segons el joc de la brisca. Empra un array associatiu per a obtenir els punts a partir del nom de la figura de la carta. Assegura't que no es repeteix cap carta, igual que si les haguessis agafat d'una baralla de veritat.</p>
<br/>
							
<pre style="font-size:1.0rem;">
<code style="color:red;">&lt;?php</code>
//Creació de les cartes
define("PALS",array("bastos","oros","espadas","copas"));
define("VALORS", array(0,11,0,10,0,0,0,0,0,0,2,3,4));

foreach (PALS as $value) {
    for ($i=1; $i<=12; $i++) {
        $baralla[] = array ("pal" => $value, "numero" =>$i);
    }
}

//agafo 10 cartes aleatories
for ($i=0; $i<10; $i++) {
     $clau = array_rand($baralla);
     $lesMevesCartes[] = $baralla[$clau];
     unset($baralla[$clau]);
}

echo "&lt;pre>";
var_dump($lesMevesCartes);
echo "&lt;/pre>";

//Calculo el valor de les cartes seleccionades
foreach ($lesMevesCartes as $carta) {
    $suma += VALORS[$carta["numero"]];
}

echo "La suma dels meus punts és de $suma";
<code style="color:red;">?></code>
</pre>						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</main>
</body>
</html>
