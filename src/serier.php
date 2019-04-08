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
			<h1>Serier</h1>
			<table>
			<tr>
			<th>Navn</th>
			<th></th>
			</tr>
			<?php
					$sql = "SELECT * FROM serie";
					$resultat = $connection->query($sql);

					while ($rad = $resultat->fetch_assoc()) {
							$serie_id = $rad['serie_id'];
							echo "<tr>";
							echo "<td>$rad[navn]</td>";
							echo "<td>";
							echo "<form method='post'>";
							echo "<button type='submit' class='btn btn-danger' name='slett_$serie_id'>Slett</button>";
							echo "</form>";
							echo "</td>";
							echo "</tr>\n";

							if(isset($_POST['slett_'.$serie_id])) {
					 					$sql = "DELETE FROM serie WHERE serie_id = $serie_id";
					 				if($connection->query($sql)) {
					 					echo "Serien er slettet";
										header("Location: #");2
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
				Serie: <input type="text" name="navn" placeholder="Super Mario" required>
				<input type="submit" value="Legg til!" name="leggtil">
				</form>
			<?php
				if(isset($_POST["leggtil"])) {
					      echo "Foobar!";
							$navn = $_POST ["navn"];

							$sql = "INSERT INTO serie (navn)
											VALUES ('$navn')";

						if($connection->query($sql)) {
							echo "Serie ble lagt til!";
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
