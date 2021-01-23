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

	<title>Lagerwert</title>
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
						$mSQL = "
							SELECT distinct
							kunden.KdNr,
							kunden.Name,
							SUM(auftragspositionen.AufMenge * artikel.VkPreis) AS Umsatz
							
							FROM kunden
							INNER JOIN auftragskoepfe
							INNER JOIN auftragspositionen
							INNER JOIN artikel
							
							WHERE auftragskoepfe.KdNr = kunden.KdNr
							AND auftragskoepfe.AufNr = auftragspositionen.AufNr
							AND auftragspositionen.ArtikelNr = artikel.ArtikelNr
							
							GROUP BY KdNr
							
							UNION
							
							SELECT distinct
							kunden.KdNr,
							kunden.Name,
							0 AS Umsatz
							
							FROM kunden
							
							WHERE KdNr NOT IN (
							SELECT distinct
							kunden.KdNr
							
							FROM kunden
							INNER JOIN auftragskoepfe
							INNER JOIN auftragspositionen
							INNER JOIN artikel
							
							WHERE auftragskoepfe.KdNr = kunden.KdNr
							AND auftragskoepfe.AufNr = auftragspositionen.AufNr
							AND auftragspositionen.ArtikelNr = artikel.ArtikelNr
							)
		
							ORDER BY Umsatz DESC, KdNr
						";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo "<div class='alert alert-info'>Keine Kunden vorhanden!</div>";
						} else {
							echo("
								<table class='table'>
									<tr>
										<th>Kunden Nummer</th>
										<th>Name</th>
										<th>Umsatz</th>
									</tr>
							");

							while ($kunde = $abfrageErgebnis->fetch_object()) {
								$kundenNummer = $kunde->KdNr;
								$name = utf8_encode($kunde->Name);
								$umsatz = number_format($kunde->Umsatz, 2, ",", ".");

								echo("
									<tr>
										<td>" . $kundenNummer . "</td>
										<td>" . $name . "</td>
										<td>" . $umsatz . "</td>
									</tr>
								");
							}

							echo("</table>");

							$abfrageErgebnis->close();
							$dbVerbindung->close();
						}
					} else {
						echo "<div class=\"alert alert-danger\" role=\"alert\">";
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