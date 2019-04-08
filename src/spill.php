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
			<h1>Spill</h1>
			<table>
			<tr>
			<th>Navn</th>
			<th>Serie</th>
			<th></th>
			</tr>
			<?php
					$ql = "SELECT spill.spill_id as spill_id, spill.navn as spill_navn, serie.navn as serie_navn FROM spill, serie WHERE spill.serie_id = serie.serie_id";
					$resultat = $connection->query($ql);

					while ($rad = $resultat->fetch_assoc()) {
							$spill_id = $rad['spill_id'];
							echo "<tr>";
							echo "<td>$rad[spill_navn]</td>";
							echo "<td>$rad[serie_navn]</td>";
							echo "<td>";
							echo "<form method='post'>";
							echo "<button type='submit' class='btn btn-danger' name='slett_$spill_id'>Slett</button>";
							echo "</form>";
							echo "</td>";
							echo "</tr>\n";
							//Gjør en delete spørring. Når man endrer tjeneren bruker man post.
							if(isset($_POST['slett_'.$spill_id])) {
					 					$sql = "DELETE FROM spill WHERE spill_id = $spill_id";
					 				if($connection->query($sql)) {
					 					echo "Spillet er slettet";
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
				Navn: <input type="text" name="navn" placeholder="GTA V" required>
				Serie:
				<select name="serie_id">
					<?php
							$ql = "SELECT * FROM serie";
							$resultat = $connection->query($ql);
							while ($rad = $resultat->fetch_assoc()) {
									echo "<option value='$rad[serie_id]'>$rad[navn] </option>";
							}
					?>
				</select>
				<input type="submit" value="Legg til!" name="leggtil">
				</form>
			<?php
				if(isset($_POST["leggtil"])) {
							$navn = $_POST ["navn"];
							$serie_id = $_POST ["serie_id"];

							$sql = "INSERT INTO spill (navn, serie_id)
											VALUES ('$navn', '$serie_id')";

						if($connection->query($sql)) {
							echo "$navn ble lagt til!";
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
