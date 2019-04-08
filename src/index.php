<?php include 'connection.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<!--<link rel = "icon" href = "/~mofr1108/Oblig6_bilbutikk/bilshappe.png">-->

		<!-- Bootstrap: http://www.w3schools.com/bootstrap/bootstrap_get_started.asp -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<title>Spillfigurer</title>
  </head>
  <body>
		<?php include 'menybar.php';?>
		<div class="container">
			<h1>Spillfigurer - roller i forskjellige spill</h1>
				<table>
				<tr>
					<th>Figur</th>
					<th>Spill</th>
					<th>Type</th>
					<th>Rolle</th>
				</tr>
				<!--Skriver ut figur, rolle, spill og serie i en synlig tabell-->
				<?php
						$ql = "SELECT figur.navn as navn, rolle.rolle as rolle, rolle.type as type, spill.navn as spill_navn, serie.navn as serie_navn
						FROM rolle, figur, spill, serie
						WHERE spill.serie_id = serie.serie_id
						AND rolle.spill_id = spill.spill_id
						AND rolle.figur_id = figur.figur_id";
						$resultat = $connection->query($ql);

						while ($rad = $resultat->fetch_assoc()) {
								echo "<tr>";
								echo "<td>$rad[navn]</td>";
								echo "<td>$rad[spill_navn] - ($rad[serie_navn])</td>";
								echo "<td>$rad[type]</td>";
								echo "<td>$rad[rolle]</td>";
								echo "</tr>\n";
						}
				?>
				</table>
				<div class="filmer">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/Ay0-5IxKk5s" allowfullscreen></iframe>
					<iframe width="560" height="315" src="https://www.youtube.com/embed/ILJmufDh-Mg" allowfullscreen></iframe>
				</div>
			<?php include 'footer.php';?>
		</div>
	</body>
</html>
