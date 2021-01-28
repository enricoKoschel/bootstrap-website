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

	<title>Artikel Bestellungen</title>
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
						$artikelNummer = $_POST['artikelnummer'];

						$mSQL = "
							SELECT distinct 
							kunden.KdNr,
							kunden.Name,
							kunden.Strasse,
							kunden.PLZ,
							kunden.Ort
		
							FROM auftragspositionen
							INNER JOIN auftragskoepfe 
							INNER JOIN kunden
		
							WHERE auftragspositionen.ArtikelNr = '$artikelNummer'
							AND auftragskoepfe.AufNr = auftragspositionen.AufNr
							AND kunden.KdNr = auftragskoepfe.KdNr
						";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-warning'>Artikel Nummer nicht vorhanden oder Artikel wurde nicht bestellt!</div>");
						} else {
							echo("
								<table class='table'>
									<tr>
										<th>Kunden Nummer</th>
										<th>Name</th>
										<th>Straße</th>
										<th>PLZ</th>
										<th>Ort</th>
									</tr>
							");

							while ($kunde = $abfrageErgebnis->fetch_object()) {
								$kundenNummer = $kunde->KdNr;
								$name = utf8_encode($kunde->Name);
								$strasse = utf8_encode($kunde->Strasse);
								$plz = utf8_encode($kunde->PLZ);
								$ort = utf8_encode($kunde->Ort);

								echo("
									<tr>
										<td>" . $kundenNummer . "</td>
										<td>" . $name . "</td>
										<td>" . $strasse . "</td>
										<td>" . $plz . "</td>
										<td>" . $ort . "</td>
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