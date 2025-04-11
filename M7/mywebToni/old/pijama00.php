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
			<table>
				<tr>
					<th></th>
					<th>Titol 1</th>
					<th>Titol 2</th>
					<th>Titol 2</th>
					<th>Acció</th>
				</tr>
				<tr>
					<td colspan='4' style='text-align:right;'>Afegir nou element ...</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 01</td>
					<td>15</td>
					<td>120</td>
					<td>-</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 02</td>
					<td>18</td>
					<td>120</td>
					<td>34</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 03</td>
					<td>25</td>
					<td>120</td>
					<td>-</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 04</td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 05</td>
					<td>10</td>
					<td>75</td>
					<td>12</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 06</td>
					<td>12</td>
					<td>75</td>
					<td>14</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 07</td>
					<td>15</td>
					<td>120</td>
					<td>-</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 08</td>
					<td>18</td>
					<td>120</td>
					<td>34</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 09</td>
					<td>25</td>
					<td>120</td>
					<td>-</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 10</td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 11</td>
					<td>10</td>
					<td>75</td>
					<td>12</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
				<tr>
					<td>Element 12</td>
					<td>12</td>
					<td>75</td>
					<td>14</td>
					<td>
						<img src='../images/edit.svg' style='width:30px; height:30px;' />
						<img src='../images/delete.svg' style='width:30px; height:30px;' />
					</td>
				</tr>
			</table>
			<div class='table-footer'>
    			<a href="pijama01.php">
    				<button class="btn" style='float:right;'>Següent</button>
    			</a>
			</div>
		</div>
		
		
	</main>
</body>
</html>
