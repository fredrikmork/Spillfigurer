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
			<br>
			<h1>Roller</h1>
				<table>
				<tr>
					<th>Figur</th>
					<th>Spill</th>
					<th>Type</th>
					<th>Rolle</th>
					<th></th>
				</tr>
				<?php
						$ql = "SELECT figur.navn as navn, rolle.rolle_id as rolle_id, rolle.rolle as rolle, rolle.type as type, spill.navn as spill_navn, serie.navn as serie_navn
						FROM rolle, figur, spill, serie
						WHERE spill.serie_id = serie.serie_id
						AND rolle.spill_id = spill.spill_id
						AND rolle.figur_id = figur.figur_id";
						$resultat = $connection->query($ql);

						while ($rad = $resultat->fetch_assoc()) {
								$rolle_id = $rad['rolle_id'];
								echo "<tr>";
								echo "<td>$rad[navn]</td>";
								echo "<td>$rad[spill_navn] - ($rad[serie_navn])</td>";
								echo "<td>$rad[type]</td>";
								echo "<td>$rad[rolle]</td>";
								echo "<td>";
								echo 		"<form method='post'>";
								echo 			"<button type='submit' class='btn btn-danger' name='slett_$rolle_id'>Slett</button>";
								echo 		"</form>";
								echo "</td>";
								echo "</tr>\n";

								if(isset($_POST['slett_'.$rolle_id])) {
						 					$sql = "DELETE FROM rolle WHERE rolle_id = $rolle_id";
						 				if($connection->query($sql)) {
						 					echo "Rollen er slettet";
											header("Location: #");
						 				} else {
						 					echo "<p>Noe gikk galt <br>
						 					Spørring: $sql <br>Feilmelding: $connection->error";
						 				}
						 		}
						}
				?>
				</table>
				<br>
				<form method="post">
					Figur:
						<select name="figur_id">
							<option value=''> -- Velg -- </option>
							<?php
								$ql = "SELECT * FROM figur";
								$resultat = $connection->query($ql);
								while ($rad = $resultat->fetch_assoc()) {
										echo "<option value='$rad[figur_id]'>$rad[navn] </option>";
								}
							?>
						</select>

					Spill:
						<select name="spill_id">
							<option value=''> -- Velg -- </option>
							<?php
									$ql = "SELECT spill.spill_id as spill_id, spill.navn as spill_navn, serie.navn as serie_navn FROM spill, serie WHERE spill.serie_id = serie.serie_id";
									$resultat = $connection->query($ql);
									while ($rad = $resultat->fetch_assoc()) {
											echo "<option value='$rad[spill_id]'>$rad[spill_navn] ($rad[serie_navn])</option>";
									}
							?>
						</select>

					Type:
						<select name="type">
							<option value=''> -- Velg -- </option>
							<option value='vennlig'>Vennlig</option>
							<option value='nøytral'>Nøytral</option>
							<option value='fiendtlig'>Fiendtlig</option>
						</select>

					Rolle:
						<select name="rolle">
							<option value=''> -- Velg -- </option>
							<option value='spillbar'>Spillbar</option>
							<option value='birolle'>Birolle</option>
						</select>
					<input type="submit" value="Legg til!" name="leggtil">
				</form>
			<?php
				if(isset($_POST["leggtil"])) {
							$figur_id = $_POST ["figur_id"];
							$rolle = $_POST ["rolle"];
							$spill_id = $_POST ["spill_id"];
							$type = $_POST ["type"];

							$sql = "INSERT INTO rolle (figur_id, rolle, spill_id, type)
											VALUES ('$figur_id', '$rolle', '$spill_id', '$type')";

						if($connection->query($sql)) {
							echo "Rolle ble lagt til!";
							header("Location: #");
						} else {
							echo "<p>Noe gikk galt <br>
							Spørring: $sql <br>Feilmelding: $connection->error</p>";
						}
				}
			?>
		<?php include 'footer.php';?>
		</div>
	</body>
</html>
