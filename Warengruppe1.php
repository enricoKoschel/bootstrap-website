<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
		  crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
			crossorigin="anonymous"></script>

	<script src="//code.jquery.com/jquery.min.js"></script>
	<script>
		$.get("nav.html", function (data) {
			$("#nav-placeholder").replaceWith(data);
		});
	</script>

	<title>Warengruppen</title>
</head>
<body>
	<div id="nav-placeholder"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
					$mServer = "localhost";
					$mBenutzer = "USER409427";
					$mKennwort = "AlarmStufeRot";
					$mDatenbank = "db_409427_2";

					$dbVerbindung = new mysqli($mServer, $mBenutzer, $mKennwort, $mDatenbank);

					if (mysqli_connect_errno() == 0) {
						$mWG = $_POST['liWG'];

						$mSQL = "SELECT ArtikelNr, Bezeichnung, VkPreis, Bestand FROM artikel WHERE WgNr = '$mWG' ORDER by ArtikelNr";
						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo "<div class='alert alert-warning'>Warengruppe existiert nicht!</div>";
						} else {
							echo("
						<table class='table'>
							<tr>
								<th>ArtikelNr</th>
								<th>Bezeichnung</th>
								<th>Verkaufspreis</th>
								<th>Lagerbestand</th>
							</tr>
					");

							while ($aktuellerArtikel = $abfrageErgebnis->fetch_object()) {
								echo "<tr><td>$aktuellerArtikel->ArtikelNr</td>";
								echo "<td>" . utf8_encode($aktuellerArtikel->Bezeichnung) . "</td>";
								echo "<td>";
								echo number_format($aktuellerArtikel->VkPreis, 2, ",", ".");
								echo "</td><td>";
								echo number_format($aktuellerArtikel->Bestand, 0, ",", ".");
								echo "</td></tr>";
							}
							echo "</table>";

							$abfrageErgebnis->close();
							$dbVerbindung->close();
						}
					} else {
						echo "<div class='alert alert-danger' role='alert'>";
						echo "<h2>Keine Datenbankverbindung</h2>";
						echo "<p>Fehler: ", mysqli_connect_error(), "</p>";
						echo "</div>";
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>