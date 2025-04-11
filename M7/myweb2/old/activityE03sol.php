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
						<h1>Pràctica E03 - Càlculs matemàtics</h1>
						<div class="practica-desc">
							<p>Calculeu les solucions d'una equació de segon grau del tipus f(x) = ax<sup>2</sup> + bx + c = 0</p>
							<p>Les variables que us cal per calcular-la son "a", "b" i "c". I caldrà que feu memòria de la famosa fórmula (<a href="https://ca.wikipedia.org/wiki/Equaci%C3%B3_de_segon_grau" >òbviament està a la Wikipèdia</a>).</p>
							<p>Presenteu-ho bé: indiqueu l'equació per pantalla, la fórmula teòrica, i la solució pels vostre valors.</p>
							<p>Per evitar errors per arrels negatives, proveu primer amb els valors a=2 b=3 c=1 . </p>
							<p>Després proveu amb altres valors.</p>
<pre style="font-size:1.0rem;">
<code style="color:red;">&lt;?php</code>
$a = 0;
$b = -1;
$c = -2;

if ($a==0) {
    "No és una equació de segon grau";
} else {
    echo "la solució de $a x<sup>2</sup> + $b x + $c = 0 és: &lt;br>";
    
    $discriminant = pow($b,2)-4*$a*$c;
    if ($discriminant > 0) {
        //Dues coucions reals:
        echo (-$b+sqrt($discriminant))/(2*$a) . " i " . (-$b-sqrt($discriminant))/(2*$a);
    } elseif ($disciminant = 0) {
        //Una solució
        echo -$b/(2*$a);
    }else {
        //Cap solució
        echo "No hi han solucions reals";
    }
}
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
