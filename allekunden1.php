<!DOCTYPE html>

<center>
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
	</head>
	<body>
		<?php
			//Datenbankvariable festlegen
			$mServer = "localhost";
			$mBenutzer = "USER409427";
			$mKennwort = "AlarmStufeRot";
			$mDatenbank = "db_409427_2";
			//Datenbankverbindung herstellen
			$dbVerbindung = new mysqli($mServer, $mBenutzer, $mKennwort, $mDatenbank);
			// Datenbankverbindung hergestellt ?
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

					ORDER BY Umsatz DESC
				";

				$abfrageErgebnis = $dbVerbindung->query($mSQL);

				if ($abfrageErgebnis->num_rows == 0) {
					echo "<h2>Keine Kunden vorhanden!</h2>";
				} else {
					echo("
						<table border =\"1\">
							<tr>
								<th>Kunden Nummer</th>
								<th>Name</th>
								<th>Umsatz</th>
							</tr>
					");

					while ($kunde = $abfrageErgebnis->fetch_object()) {
						$kundenNummer = $kunde->KdNr;
						$name = utf8_encode($kunde->Name);
						$umsatz = $kunde->Umsatz;

						echo("
							<tr>
								<td>" . $kundenNummer . "</td>
								<td>" . $name . "</td>
								<td>" . $umsatz . "</td>
							</tr>
						");
					}

					echo("</table>");

					// Ergebnistabellenobjekt und Datenbankverbindung schließen
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
		<a href="index.html"><h1>Startseite</h1></a>
	</body>
</center>