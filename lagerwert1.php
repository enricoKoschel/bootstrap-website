<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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

	<title>Lagerwert</title>
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
						$mSQL = "
							SELECT distinct 
							ArtikelNr,
							Bezeichnung,
							VkPreis * Bestand AS Lagerwert
		
							FROM artikel
		
							ORDER BY Lagerwert DESC
						";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-info'>Keine Artikel vorhanden!</div>");
						} else {
							echo("
								<table class='table'>
									<tr>
										<th>Artikel Nummer</th>
										<th>Bezeichnung</th>
										<th>Lagerwert</th>
									</tr>
							");

							$gesamtLagerwert = 0;

							while ($artikel = $abfrageErgebnis->fetch_object()) {
								$artikelNummer = $artikel->ArtikelNr;
								$bezeichnung = utf8_encode($artikel->Bezeichnung);
								$lagerwert = $artikel->Lagerwert;

								echo("
									<tr>
										<td>" . $artikelNummer . "</td>
										<td>" . $bezeichnung . "</td>
										<td>" . number_format($lagerwert, 2, ",", ".") . "</td>
									</tr>
								");

								$gesamtLagerwert += $lagerwert;
							}

							echo("
								<tr>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							");
							echo("
								<tr>
									<td></td>
									<td><b>Gesamt Lagerwert</b></td>
									<td><b>" . number_format($gesamtLagerwert, 2, ",", ".") . "</b></td>
								</tr>
							");

							echo("</table>");

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