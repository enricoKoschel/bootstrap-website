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

	<title>Kunden Bestellungen</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="nav-placeholder"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
					$mServer = "localhost";
					$mBenutzer = "USER409427";
					$mKennwort = "AlarmStufeRot";
					$mDatenbank = "db_409427_2";

					$dbVerbindung = new mysqli($mServer, $mBenutzer, $mKennwort, $mDatenbank);

					if (mysqli_connect_errno() == 0) {
						$kundennummer = $_POST['kundennummer'];
						$passwort = $_POST['passwort'];

						$mSQL = "SELECT Passwort FROM kunden WHERE KdNr = '$kundennummer'";
						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-warning'>Kundennummer nicht vorhanden!</div>");
							return;
						} else if ($abfrageErgebnis->fetch_object()->Passwort != $passwort) {
							echo("<div class='alert alert-warning'>Falsches Passwort!</div>");
							return;
						}

						$mSQL = "
							SELECT distinct 
							auftragspositionen.AufNr, 
							artikel.ArtikelNr, 
							artikel.Bezeichnung, 
							auftragspositionen.AufMenge,
							auftragskoepfe.AufDat,
							auftragskoepfe.AufTermin,
							auftragspositionen.AufPosNr,
							artikel.VkPreis

							FROM kunden 
							INNER JOIN auftragskoepfe 
							INNER JOIN artikel 
							INNER JOIN auftragspositionen 

							WHERE auftragskoepfe.KdNr = '$kundennummer' 
							AND auftragskoepfe.AufNr = auftragspositionen.AufNr 
							AND auftragspositionen.ArtikelNr = artikel.ArtikelNr
						";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo "<div class='alert alert-info'>Keine Bestellungen vorhanden!</div>";
						} else {
							echo("
								<table class='table'>
									<tr>
										<th>AufNr</th>
										<th>AufDat</th>
										<th>AufTermin</th>
										<th>AufPos</th>
										<th>ArtikelNr</th>
										<th>Bezeichnung</th>
										<th>AufMenge</th>
										<th>VKPreis</th>
									</tr>
							");

							while ($auftrag = $abfrageErgebnis->fetch_object()) {
								$auftragsNummer = $auftrag->AufNr;
								$auftragsDatum = date("d.m.Y", strtotime($auftrag->AufDat));
								$auftragsTermin = date("d.m.Y", strtotime($auftrag->AufTermin));
								$auftragsPos = $auftrag->AufPosNr;
								$artikelNummer = $auftrag->ArtikelNr;
								$bezeichnung = utf8_encode($auftrag->Bezeichnung);
								$auftragsMenge = number_format($auftrag->AufMenge, 0, ",", ".");
								$verkaufsPreis = number_format($auftrag->VkPreis, 2, ",", ".");

								echo("
									<tr>
										<td>" . $auftragsNummer . "</td>
										<td>" . $auftragsDatum . "</td>
										<td>" . $auftragsTermin . "</td>
										<td>" . $auftragsPos . "</td>
										<td>" . $artikelNummer . "</td>
										<td>" . $bezeichnung . "</td>
										<td>" . $auftragsMenge . "</td>
										<td>" . $verkaufsPreis . "</td>
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