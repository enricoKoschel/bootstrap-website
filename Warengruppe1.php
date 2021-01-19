<center>
	<head>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php
			//Datenbankvariable festlegen
			$mServer="localhost";
			$mBenutzer = "USER409427";
			$mKennwort = "AlarmStufeRot";
			$mDatenbank = "db_409427_2";
			//Datenbankverbindung herstellen
			$dbVerbindung = new mysqli($mServer, $mBenutzer, $mKennwort, $mDatenbank);
			// Datenbankverbindung hergestellt ?
			if(mysqli_connect_errno() == 0)
			{  
				// Datenübernahme aus der Form
				$mWG = $_POST['liWG'];
				// SQL-Anweisung erstellen
				$mSQL = "SELECT ArtikelNr, Bezeichnung, VkPreis, Bestand FROM artikel WHERE WgNr = '$mWG' ORDER by ArtikelNr";
				// Ergebnistabellenobjekt mErgebnis mit mSQL bilden
				$abfrageErgebnis = $dbVerbindung->query($mSQL);
				if ($abfrageErgebnis->num_rows == 0)
				{ 
					echo "<h2>Fehler: Diese Warengruppe gibt es nicht.</h2>";
				}
				else
				{
					echo("
						<table border =\"1\">
							<colgroup>
								<col width=\"50\" />
								<col width=\"200\" />
								<col width=\"50\" />
								<col width=\"50\" />
							</colgroup>
							<tr>
								<th>ArtikelNr</th>
								<th>Bezeichnung</th>
								<th>Verkaufspreis</th>
								<th>Lagerbestand</th>
							</tr>
					");

					while ($aktuellerArtikel = $abfrageErgebnis->fetch_object())			 				  
					{ 
						$bezeichnung = utf8_encode($aktuellerArtikel->Bezeichnung); 
						echo "<tr><td> $aktuellerArtikel->ArtikelNr </td>";
						echo "<td> $bezeichnung </td>";
						echo "<td class = 'rechts'>";
						echo number_format($aktuellerArtikel->VkPreis, 2, ",", ".");
						echo "</td><td class = 'rechts'>";
						echo number_format($aktuellerArtikel->Bestand, 0, ",", ".");
						echo "</td></tr>";
					}
					echo "</table>";
					
					// Ergebnistabellenobjekt und Datenbankverbindung schließen
					$abfrageErgebnis->close();
					$dbVerbindung->close();
				}
			}
			else
			{ 
				echo "<div class=\"alert alert-danger\" role=\"alert\">";
				echo "<h2>Keine Datenbankverbindung</h2>";
				echo "<p>Fehler: ", mysqli_connect_error(), "</p>";
				echo "</div>";
			}
		?>
		<a href="index.html"><h1>Startseite</h1></a>
	</body>
</center>