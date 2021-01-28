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

	<title>Fehlmengen</title>
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
							Bestand,
							MeldeBest - Bestand AS Fehlmenge
		
							FROM artikel
		
							WHERE (MeldeBest - Bestand) > 0
							
							ORDER BY Fehlmenge DESC
						";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-info'>Keine Artikel müssen gekauft werden!</div>");
						} else {
							echo("
								<table class='table'>
									<tr>
										<th>Artikel Nummer</th>
										<th>Bezeichnung</th>
										<th>Menge</th>
										<th>Fehlmenge</th>
									</tr>
							");

							while ($artikel = $abfrageErgebnis->fetch_object()) {
								$artikelNummer = $artikel->ArtikelNr;
								$bezeichnung = utf8_encode($artikel->Bezeichnung);
								$menge = $artikel->Bestand;
								$fehlmenge = $artikel->Fehlmenge;

								echo("
									<tr>
										<td>" . $artikelNummer . "</td>
										<td>" . $bezeichnung . "</td>
										<td>" . $menge . "</td>
										<td>" . $fehlmenge . "</td>
									</tr>
								");
							}

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